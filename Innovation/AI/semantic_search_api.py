from flask import Flask, request, jsonify
from sentence_transformers import SentenceTransformer, util
import pandas as pd
import numpy as np

app = Flask(__name__)

# Load data and pre-trained model
past_projects_df = pd.read_csv('content/past_projects.csv')
past_projects = past_projects_df['description'].tolist()
past_project_names = past_projects_df['name'].tolist()

# Load improved SentenceTransformer model
model = SentenceTransformer('all-mpnet-base-v2')

# Encode past projects
past_projects_embeddings = model.encode(past_projects, convert_to_tensor=True)

# Define stop words
STOP_WORDS = {
    "it's", "ksu", "the", "this", "that", "application", "platform",
    "is", "an", "designed", "to", "by", " ", ".", ",", "mobile",
    "developed", "AI", "artificial intelligence", "virtual reality"
}

def preprocess(doc):
    """Preprocess text by removing stop words."""
    return {word.lower() for word in doc.split() if word.lower() not in STOP_WORDS}

def dice_coefficient(set1, set2):
    """Calculate Dice coefficient similarity."""
    intersection = len(set1.intersection(set2))
    return 2 * intersection / (len(set1) + len(set2)) if (len(set1) + len(set2)) > 0 else 0

@app.route("/check_duplicate", methods=["POST"])
def check_duplicate():
    data = request.get_json()
    new_idea = data.get("idea", "")

    if not new_idea:
        return jsonify({"error": "No idea provided"}), 400

    # Encode new project idea
    new_project_embedding = model.encode(new_idea, convert_to_tensor=True)
    
    # Compute semantic similarity using cosine similarity
    semantic_similarities = util.cos_sim(new_project_embedding, past_projects_embeddings)[0].tolist()
    semantic_scores = sorted(
        zip(past_project_names, semantic_similarities), key=lambda x: x[1], reverse=True
    )

    # Get the highest similarity project using semantic search
    best_match = semantic_scores[0]
    
    # Dice Coefficient Similarity Calculation
    preprocessed_query = preprocess(new_idea)
    preprocessed_descriptions = [preprocess(doc) for doc in past_projects]
    dice_similarities = [
        dice_coefficient(preprocessed_query, description) for description in preprocessed_descriptions
    ]
    
    # Get the best Dice similarity project
    best_dice_match = max(zip(past_project_names, dice_similarities), key=lambda x: x[1])

    return jsonify({
        "semantic_similarity": {
            "project_name": best_match[0],
            "similarity": best_match[1]
        },
        "dice_coefficient": {
            "project_name": best_dice_match[0],
            "similarity": best_dice_match[1]
        }
    })

@app.route("/")
def home():
    return "Flask is running!"

if __name__ == "__main__":
    app.run(debug=True)

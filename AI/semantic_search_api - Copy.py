from sentence_transformers import SentenceTransformer
import pandas as pd
from sklearn.metrics import jaccard_score
from collections import Counter
from flask import Flask
from flask import Flask, request, jsonify


app = Flask(__name__)


# Load data and pre-trained model
past_projects_df = pd.read_csv('content/past_projects.csv')
past_projects = past_projects_df['description'].tolist()
past_project_names = past_projects_df['name'].tolist()

# Load pre-trained sentence embedding model
model = SentenceTransformer('all-MiniLM-L6-v2')

@app.route("/check_duplicate", methods=["POST"])
def check_duplicate():
        data = request.get_json()
        new_idea = data.get("idea", "")

        if not new_idea:
            return jsonify({"error": "No idea provided"}), 400
        
        # Encode ideas into embeddings
        new_embedding = model.encode(new_idea)
        past_embeddings = model.encode(past_projects)

        # Compute cosine similarity
        similarities = [
            (name, new_embedding @ past_embedding / (sum(new_embedding**2)**0.5 * sum(past_embedding**2)**0.5))
            for name, past_embedding in zip(past_project_names, past_embeddings)]

        # Get the highest similarity project
        best_match = max(similarities, key=lambda x: x[1])

        return jsonify({"project_name": best_match[0], "similarity": best_match[1]})

if __name__ == "__main__":
    app.run(debug=True)

def home():
    return "Flask is running!"


# Install POT


# New project idea
new_project_idea = "web application streamlining job searches by connecting job seekers with recruiters. It leverages advanced technology to automate skill extraction from CVs and job postings using the SkillNer NLP module"

# Define stop words
STOP_WORDS = {"it's","ksu", "the","this","that" "application", "platform", "is","an","designed","to","by"," ",".",",","mobile","developed","AI","arifical intellgence","virtual reality"}

# Function to preprocess text by removing stop words
def preprocess(doc):
    return [word.lower() for word in doc.split() if word.lower() not in STOP_WORDS]

# Function to calculate Dice coefficient
def dice_coefficient(set1, set2):
    intersection = len(set1.intersection(set2))
    return 2 * intersection / (len(set1) + len(set2)) if (len(set1) + len(set2)) > 0 else 0

# Preprocess the descriptions
preprocessed_query = set(preprocess(new_project_idea))
preprocessed_descriptions = [set(preprocess(doc)) for doc in past_projects]

# Calculate Dice coefficient similarities
dice_similarities = [dice_coefficient(preprocessed_query, description) for description in preprocessed_descriptions]

# Rank similarity scores
ranked_dice_scores = sorted(zip(past_projects_df['name'], dice_similarities), key=lambda x: x[1], reverse=True)

# Display results
print("Top 3 Similar Projects (Dice Coefficient):")
for i, (project_name, similarity) in enumerate(ranked_dice_scores[:3]):
    print(f"{i + 1}. {project_name} - Dice Coefficient: {similarity:.4f}")


from flask import Flask, request, jsonify
import pandas as pd
from sklearn.metrics.pairwise import cosine_similarity
import mysql.connector
from sentence_transformers import SentenceTransformer

app = Flask(__name__)

model = SentenceTransformer('all-MiniLM-L6-v2')

# Connect to MySQL Database
def get_db_connection():
    return mysql.connector.connect(
        host='localhost',
        user='root',
        password='root',
        database='InnovationEngine'
    )

# Function to get supervisor data from the database
def get_supervisors():
    connection = get_db_connection()
    cursor = connection.cursor()

    # Fetch data from the supervisors table
    query = "SELECT email, name, interest, availability FROM supervisors"
    cursor.execute(query)
    data = cursor.fetchall()

    # Convert to pandas DataFrame
    df = pd.DataFrame(data, columns=["email", "name", "interest", "availability"])

    # Close the connection
    cursor.close()
    connection.close()

    return df

# Function to get student interests (directly as text)
def get_student_interests(student_id):
    connection = get_db_connection()
    cursor = connection.cursor()

    # Fetch interest text from the student table
    query = "SELECT interest FROM students WHERE email=%s"
    cursor.execute(query, (student_id,))
    result = cursor.fetchone()

    cursor.close()
    connection.close()

    # If no result found, return an empty string
    if not result:
        return ""

    # Return the interests as a single string for processing
    return result[0]

# Synonym mapping
synonym_map = {
    "Machine Learning": ["ML", "machine learning"],
    "Deep Learning": ["DL", "deep learning"],
    "Artificial Intelligence": ["AI", "artificial intelligence"],
    "Natural Language Processing": ["NLP", "natural language processing"],
    "Text Analysis": ["TA", "text analysis"],
    "Cloud Computing": ["Cloud", "AWS", "Azure", "GCP", "cloud computing"],
    "Face Recognition": ["Face ID", "face recognition"],
    "Internet of Things": ["IoT", "internet of things"],
    "Smart Devices": ["SD", "smart devices"],
    "Networking Technologies": ["Networking", "Computer Networks", "networking", "networks"],
    "Data Monitoring": ["Monitoring", "data monitoring"],
    "Data Analysis": ["DA", "data analysis"],
    "Big Data": ["BD", "big data"],
    "Recommendation System": ["Recommender", "recommendation system"],
    "Recommendation Engines": ["RE", "recommendation engines"]
}

# Text normalization and expansion
def normalize_text(text):
    return text.lower()

def expand_text(text):
    text = normalize_text(text)
    for key, synonyms in synonym_map.items():
        key_lower = key.lower()
        for synonym in synonyms:
            text = text.replace(synonym.lower(), key_lower)
    return text

class SupervisorRecommender:
    def __init__(self, supervisors):
        self.supervisors = supervisors.dropna(subset=['interest'])
        self.supervisors['expanded_interest'] = self.supervisors['interest'].apply(lambda x: expand_text(normalize_text(x)))
        
        # Extracting embeddings for the full interest text
        self.supervisors['embeddings'] = self.supervisors['expanded_interest'].apply(lambda x: model.encode(x))

    def recommend_supervisors(self, student_interests):
        expanded_student_interests = expand_text(normalize_text(student_interests))
        student_vector = model.encode(expanded_student_interests)
        
        # Calculate similarity using cosine similarity
        similarity_scores = []
        for index, row in self.supervisors.iterrows():
            score = cosine_similarity([student_vector], [row['embeddings']])[0][0]
            similarity_scores.append(score)
        
        self.supervisors['similarity'] = similarity_scores
        
        # Filter supervisors based on the highest similarity scores
        recommended = self.supervisors[self.supervisors['similarity'] > 0.5]
        recommended = recommended.sort_values(by='similarity', ascending=False)
        
        recommendations = []
        for _, supervisor in recommended.iterrows():
            recommendations.append({
                "email": supervisor["email"],
                "name": supervisor["name"],
                "interest": supervisor["interest"],
                "availability": supervisor["availability"],
                "similarity_score": round(supervisor["similarity"], 2)
            })
        return recommendations

@app.route("/recommend", methods=["GET"])
def recommend():
    student_id = request.args.get("student_id")
    if not student_id:
        return jsonify({"error": "Missing student_id"}), 400
    
    student_interests = get_student_interests(student_id)
    if not student_interests:
        return jsonify({"error": "No interests found for student"}), 404
    
    supervisors_df = get_supervisors()
    recommender = SupervisorRecommender(supervisors_df)
    recommendations = recommender.recommend_supervisors(student_interests)
    
    return jsonify({"recommended_supervisors": recommendations})

if __name__ == "__main__":
    app.run(debug=True)






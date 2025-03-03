# Import necessary libraries
from flask import Flask, jsonify
import mysql.connector
import pandas as pd
import argparse

app = Flask(__name__)

# Synonym Mapping for normalizing interests
synonym_map = {
    "Machine Learning": ["ML", "machine learning"],
    "Deep Learning": ["DL", "deep learning"],
    "Artificial Intelligence": ["AI", "artificial intelligence"],
    "Natural Language Processing": ["NLP", "natural language processing"],
    "Text Analysis": ["TA", "text analysis"],
    "Cloud Computing": ["Cloud", "AWS", "Azure", "GCP"],
    "Face Recognition": ["Face ID", "face recognition"],
    "Internet of Things": ["IoT", "internet of things", "smart devices"],
    "Smart Devices": ["SD", "smart devices"],
    "Networking Technologies": ["Networking", "Computer Networks"],
    "Data Monitoring": ["Monitoring"],
    "Data Analysis": ["DA", "data analysis"],
    "Big Data": ["BD", "big data"],
    "Recommendation System": ["Recommender", "recommendation system"],
    "Recommendation Engines": ["RE", "recommendation engines"]
}

# Function to connect to MySQL Database
def get_db_connection():
    return mysql.connector.connect(
        host='localhost',       # Use 'localhost' if the database is on the same server
        user='root',            # MySQL username
        password='root',        # MySQL password
        database='InnovationEngine'  # Database name
    )

# Function to read supervisor data from the database
def get_supervisors():
    with get_db_connection() as connection:
        cursor = connection.cursor()
        query = "SELECT email, name, interest, availability FROM supervisors"
        cursor.execute(query)
        data = cursor.fetchall()
        cursor.close()

    return pd.DataFrame(data, columns=["email", "name", "interest", "availability"])

# Normalize text by converting to lowercase and removing extra spaces
def normalize_text(text):
    if pd.isna(text):
        return ""
    return ', '.join([item.strip().lower() for item in text.split(',')])

# Expand text using synonyms from the synonym_map
def expand_text(text):
    text = normalize_text(text)
    for key, synonyms in synonym_map.items():
        key_lower = key.lower()
        for synonym in synonyms:
            text = text.replace(synonym.lower(), key_lower)
    return text

# Calculate similarity based on common interests
def calculate_similarity(target_interests, other_interests):
    target_set = set(target_interests.split(', '))
    other_set = set(other_interests.split(', '))
    common_interests = target_set.intersection(other_set)
    return len(common_interests), common_interests

# Find similar supervisors based on shared interests
def find_similar_supervisors(selected_supervisor_email, supervisors_df):
    selected_supervisor_row = supervisors_df[supervisors_df['email'] == selected_supervisor_email]
    
    if selected_supervisor_row.empty:
        return []

    selected_supervisor = selected_supervisor_row.iloc[0]
    selected_interests = expand_text(selected_supervisor['interest'])

    similarities = []

    for _, row in supervisors_df.iterrows():
        if row['email'] == selected_supervisor_email:
            continue
        
        other_interests = expand_text(row['interest'])
        similarity_count, common_interests = calculate_similarity(selected_interests, other_interests)
        
        if similarity_count > 0:
            similarities.append({
                "email": row["email"],
                "name": row["name"],
                "interest": row["interest"],
                "availability": row["availability"],
                "common_interests": list(common_interests),
                "similarity_count": similarity_count
            })

    # Sort supervisors by similarity count in descending order
    sorted_similarities = sorted(similarities, key=lambda x: x['similarity_count'], reverse=True)
    
    # Return top 4 most similar supervisors
    return sorted_similarities[:4]

# Test Route to check server status
@app.route('/test', methods=['GET'])
def test():
    return jsonify({"message": "Server is running!"})

# Flask route to get similar supervisors
@app.route('/supervisor/<email>', methods=['GET'])
def get_similar_supervisors(email):
    supervisors_df = get_supervisors()

    # Check if selected supervisor exists
    if email not in supervisors_df['email'].values:
        return jsonify({"error": "Supervisor not found"}), 404

    # Get similar supervisors
    similar_supervisors = find_similar_supervisors(email, supervisors_df)

    # Return results as JSON
    return jsonify({"similar_supervisors": similar_supervisors})

# Run Flask app with a specified port
if __name__ == '__main__':
    parser = argparse.ArgumentParser(description="Run Flask App")
    parser.add_argument('--port', type=int, default=5000, help="Port number for the Flask server")
    args = parser.parse_args()

    app.run(debug=True, port=args.port)


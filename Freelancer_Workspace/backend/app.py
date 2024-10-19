from flask import Flask, request, jsonify
from flask_cors import CORS
import git
import os

app = Flask(__name__)
CORS(app)
# Paths for repositories and uploaded files
REPO_BASE_PATH = os.path.join(os.getcwd(), 'repos')
UPLOAD_FOLDER = os.path.join(os.getcwd(), 'uploaded_files')

# Create folders if they don't exist
os.makedirs(REPO_BASE_PATH, exist_ok=True)
os.makedirs(UPLOAD_FOLDER, exist_ok=True)

@app.route('/create_repo', methods=['POST'])
def create_repo():
    repo_name = request.json['repo_name']
    repo_path = os.path.join(REPO_BASE_PATH, repo_name)
    if not os.path.exists(repo_path):
        git.Repo.init(repo_path)
        return jsonify({"message": f"Repository {repo_name} created."}), 201
    return jsonify({"error": "Repository already exists"}), 400

# Commit changes to the repository
@app.route('/commit', methods=['POST'])
def commit():
    repo_name = request.json['repo_name']
    commit_message = request.json['commit_message']
    repo_path = os.path.join(REPO_BASE_PATH, repo_name)
    if os.path.exists(repo_path):
        repo = git.Repo(repo_path)
        repo.git.add(A=True)
        repo.index.commit(commit_message)
        return jsonify({"message": "Changes committed."}), 200
    return jsonify({"error": "Repository not found."}), 404
@app.route('/get_commits', methods=['POST'])
def get_commits():
    try:
        repo_name = request.json['repo_name']
        repo_path = os.path.join(REPO_BASE_PATH, repo_name)

        if not os.path.exists(repo_path):
            return jsonify({"error": "Repository not found."}), 404

        repo = git.Repo(repo_path)
        commits = []
        for commit in repo.iter_commits():
            # commit.stats.files is a dictionary where keys are file names (paths)
            files_changed = list(commit.stats.files.keys())  # Get the file paths

            commits.append({
                "hash": commit.hexsha,
                "message": commit.message,
                "author": commit.author.name,
                "date": commit.committed_datetime.strftime("%Y-%m-%d %H:%M:%S"),
                "files": files_changed,  # Include the file names in the commit
            })

        return jsonify({"commits": commits, "repo_name": repo_name}), 200
    except Exception as e:
        # Log the error for debugging purposes
        print(f"Error fetching commits for {repo_name}: {e}")
        return jsonify({"error": f"An unknown error occurred: {str(e)}"}), 500


# Upload a file
@app.route('/upload_file', methods=['POST'])
def upload_file():
    # Get the repository name from the request
    repo_name = request.form.get('repo_name')
    
    # Ensure that the repository exists
    repo_path = os.path.join(REPO_BASE_PATH, repo_name)
    if not os.path.exists(repo_path):
        return jsonify({"error": f"Repository {repo_name} does not exist."}), 404

    # Check if a file was uploaded
    if 'file' not in request.files:
        return jsonify({"error": "No file part"}), 400
    
    file = request.files['file']

    # Check if the file has a valid filename
    if file.filename == '':
        return jsonify({"error": "No selected file"}), 400

    # Save the file into the repository folder
    file.save(os.path.join(repo_path, file.filename))
    
    return jsonify({"message": f"File uploaded successfully to {repo_name}."}), 200

if __name__ == "__main__":
    app.run(debug=True)

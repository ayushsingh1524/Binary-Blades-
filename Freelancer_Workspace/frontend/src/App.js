import React, { useState } from 'react';
import axios from 'axios';
import './App.css'; // Link to the CSS file

function App() {
  const [repoName, setRepoName] = useState("");
  const [commitMessage, setCommitMessage] = useState("");
  const [file, setFile] = useState(null);
  const [commits, setCommits] = useState([]);

  // Create a new repository
  const createRepo = () => {
    axios.post('http://localhost:5000/create_repo', { repo_name: repoName })
      .then(res => alert(res.data.message))
      .catch(err => alert(err.response.data.error));
  };

  // Commit changes to a repository
  const commitChanges = () => {
    axios.post('http://localhost:5000/commit', { repo_name: repoName, commit_message: commitMessage })
      .then(res => alert(res.data.message))
      .catch(err => alert(err.response.data.error));
  };

  // Fetch and display commit history
  const fetchCommits = () => {
    axios.post('http://localhost:5000/get_commits', { repo_name: repoName })
      .then(res => {
        if (res.data.commits) {
          setCommits(res.data.commits);
        } else {
          alert('No commits found.');
        }
      })
      .catch(err => alert(err.response.data.error));
  };

  // Upload a file to the repository
  const uploadFile = () => {
    if (!file || !repoName) {
      alert('Please select a file and specify a repository name.');
      return;
    }

    const formData = new FormData();
    formData.append('file', file);
    formData.append('repo_name', repoName);

    axios.post('http://localhost:5000/upload_file', formData)
      .then(res => alert(res.data.message))
      .catch(err => alert(err.response.data.error));
  };

  return (
    <div className="container">
      <h1>SyncWork Workspace</h1>

      {/* Repository Creation */}
      <input
        type="text"
        placeholder="Repository Name"
        value={repoName}
        onChange={e => setRepoName(e.target.value)}
      />
      <button onClick={createRepo}>Create Repo</button>

      {/* File Upload */}
      <input type="file" onChange={e => setFile(e.target.files[0])} />
      <button onClick={uploadFile}>Upload File</button>

      {/* Commit Changes */}
      <input
        type="text"
        placeholder="Commit Message"
        value={commitMessage}
        onChange={e => setCommitMessage(e.target.value)}
      />
      <button onClick={commitChanges}>Commit Changes</button>

      {/* Fetch and Show Commit History */}
      <button onClick={fetchCommits}>View Commit History</button>

      {/* Render the commit history */}
      {commits.length > 0 && (
        <div className="commit-history">
          <h2>Commit History for Repository: {repoName}</h2>
          <ul>
            {commits.map((commit, index) => (
              <li key={index}>
                <p><strong>Message:</strong> {commit.message}</p>
                <p><strong>Author:</strong> {commit.author}</p>
                <p><strong>Date:</strong> {commit.date}</p>
                <p><strong>Files Changed:</strong></p>
                <ul>
                  {commit.files.map((file, idx) => (
                    <li key={idx}>{file}</li>
                  ))}
                </ul>
              </li>
            ))}
          </ul>
        </div>
      )}
    </div>
  );
}

export default App;

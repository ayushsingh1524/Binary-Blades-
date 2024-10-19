// src/index.js

import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css'; // Optional, you can include any global styles here
import App from './App';
import reportWebVitals from './reportWebVitals'; // Optional: for performance tracking

// Create the root element and render the App component
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);

// Optional: For performance monitoring in your app (can be removed if not needed)
reportWebVitals();

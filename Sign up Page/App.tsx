// src/App.tsx

import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import GeneralInfoPage from './pages/GeneralInfoPage';
import RoleSelectionPage from './pages/RoleSelectionPage';
import FreelancerDetailsPage from './pages/FreelancerDetailsPage';
import ClientDetailsPage from './pages/ClientDetailsPage';

const App: React.FC = () => {
  return (
    <Router>
      <Routes>
        {/* Default route for the general information page */}
        <Route path="/" element={<GeneralInfoPage />} />

        {/* Role selection page route */}
        <Route path="/role-selection" element={<RoleSelectionPage />} />

        {/* Freelancer details form page route */}
        <Route path="/freelancer-details" element={<FreelancerDetailsPage />} />

        {/* Client details form page route */}
        <Route path="/client-details" element={<ClientDetailsPage />} />
      </Routes>
    </Router>
  );
};

export default App;

// src/pages/RoleSelectionPage.tsx

import React from 'react';
import { useNavigate } from 'react-router-dom';

const RoleSelectionPage: React.FC = () => {
  const navigate = useNavigate();

  const handleRoleSelection = (role: string) => {
    if (role === 'freelancer') {
      navigate('/freelancer-details'); // Navigate to the Freelancer details page
    } else if (role === 'client') {
      navigate('/client-details'); // Navigate to the Client details page
    }
  };

  return (
    <div>
      <h1>Select Your Role</h1>
      <button onClick={() => handleRoleSelection('freelancer')}>Freelancer</button>
      <button onClick={() => handleRoleSelection('client')}>Client</button>
    </div>
  );
};

export default RoleSelectionPage;

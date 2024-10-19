// src/pages/ClientDetailsPage.tsx

import React, { useState } from 'react';

const ClientDetailsPage: React.FC = () => {
  const [clientData, setClientData] = useState({
    companyName: '',
    industry: '',
    budgetRange: '',
    projectRequirements: '',
    preferredSkills: ''
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setClientData({ ...clientData, [e.target.name]: e.target.value });
  };

  const handleSubmit = () => {
    // Add form submission logic
    console.log(clientData);
  };

  return (
    <div>
      <h1>Client Details</h1>
      <input type="text" name="companyName" placeholder="Company Name" onChange={handleChange} />
      <input type="text" name="industry" placeholder="Industry" onChange={handleChange} />
      <input type="text" name="budgetRange" placeholder="Budget Range" onChange={handleChange} />
      <input type="text" name="projectRequirements" placeholder="Project Requirements" onChange={handleChange} />
      <input type="text" name="preferredSkills" placeholder="Preferred Skills" onChange={handleChange} />
      <button onClick={handleSubmit}>Submit</button>
    </div>
  );
};

export default ClientDetailsPage;

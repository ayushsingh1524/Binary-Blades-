// src/pages/FreelancerDetailsPage.tsx

import React, { useState } from 'react';

const FreelancerDetailsPage: React.FC = () => {
  const [freelancerData, setFreelancerData] = useState({
    skills: '',
    experience: '',
    portfolioLinks: '',
    bio: '',
    hourlyRate: '',
    availability: '',
    location: ''
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setFreelancerData({ ...freelancerData, [e.target.name]: e.target.value });
  };

  const handleSubmit = () => {
    // Add form submission logic
    console.log(freelancerData);
  };

  return (
    <div>
      <h1>Freelancer Details</h1>
      <input type="text" name="skills" placeholder="Skills" onChange={handleChange} />
      <input type="text" name="experience" placeholder="Experience Level" onChange={handleChange} />
      <input type="text" name="portfolioLinks" placeholder="Portfolio Links" onChange={handleChange} />
      <input type="text" name="bio" placeholder="Bio" onChange={handleChange} />
      <input type="text" name="hourlyRate" placeholder="Hourly Rate" onChange={handleChange} />
      <input type="text" name="availability" placeholder="Availability" onChange={handleChange} />
      <input type="text" name="location" placeholder="Location" onChange={handleChange} />
      <button onClick={handleSubmit}>Submit</button>
    </div>
  );
};

export default FreelancerDetailsPage;

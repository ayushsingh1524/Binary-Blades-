// src/pages/GeneralInfoPage.tsx

import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

const GeneralInfoPage: React.FC = () => {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({
    fullName: '',
    email: '',
    password: '',
    confirmPassword: '',
    username: '',
    phoneNumber: '',
    profilePicture: ''
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleNext = () => {
    // Add form validation logic if needed
    navigate('/role-selection');
  };

  return (
    <div>
      <h1>Sign Up</h1>
      <input type="text" name="fullName" placeholder="Full Name" onChange={handleChange} />
      <input type="email" name="email" placeholder="Email Address" onChange={handleChange} />
      <input type="password" name="password" placeholder="Password" onChange={handleChange} />
      <input type="password" name="confirmPassword" placeholder="Confirm Password" onChange={handleChange} />
      <input type="text" name="username" placeholder="Username (Optional)" onChange={handleChange} />
      <input type="tel" name="phoneNumber" placeholder="Phone Number (Optional)" onChange={handleChange} />
      <input type="file" name="profilePicture" onChange={handleChange} />
      <button onClick={handleNext}>Next</button>
    </div>
  );
};

export default GeneralInfoPage;

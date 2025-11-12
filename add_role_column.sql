-- Add role column to faculty_list table
ALTER TABLE faculty_list 
ADD COLUMN role ENUM('Subject Teacher', 'Adviser', 'Both') DEFAULT 'Subject Teacher' AFTER gender;

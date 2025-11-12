-- Add gender field to faculty_list table
-- This will allow displaying Mr./Ms. titles in the faculty list

ALTER TABLE `faculty_list` 
ADD COLUMN `gender` ENUM('Male', 'Female') NOT NULL DEFAULT 'Male' 
AFTER `lastname`;

-- Update existing records with sample data (you can modify these as needed)
UPDATE `faculty_list` SET `gender` = 'Male' WHERE `firstname` = 'George';
UPDATE `faculty_list` SET `gender` = 'Male' WHERE `firstname` = 'Carl';

-- You can add more UPDATE statements for your existing faculty members
-- Example:
-- UPDATE `faculty_list` SET `gender` = 'Female' WHERE `firstname` = 'Maria';
-- UPDATE `faculty_list` SET `gender` = 'Male' WHERE `firstname` = 'John';

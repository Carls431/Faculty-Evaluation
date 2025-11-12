-- Add start and end date fields to academic_list table
-- This allows admins to set the evaluation period for each academic year/quarter

ALTER TABLE `academic_list` 
ADD COLUMN `start_date` DATE NULL DEFAULT NULL AFTER `status`,
ADD COLUMN `end_date` DATE NULL DEFAULT NULL AFTER `start_date`;

-- Optional: Update existing records with sample dates
-- You can modify these dates as needed
UPDATE `academic_list` SET 
    `start_date` = '2024-10-01',
    `end_date` = '2024-12-31'
WHERE `year` = '2024-2025' AND `quarter` = 2;

-- Note: After running this, you can set the dates in the Admin Panel -> Academic Year -> Edit

-- Add comment field to evaluation_list table
ALTER TABLE `evaluation_list` ADD COLUMN `comment` TEXT NULL DEFAULT NULL AFTER `date_taken`;
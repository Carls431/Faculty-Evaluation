-- Add OTP columns to student_list table
ALTER TABLE `student_list` 
ADD COLUMN `otp` VARCHAR(6) NULL DEFAULT NULL AFTER `avatar`,
ADD COLUMN `otp_expires` DATETIME NULL DEFAULT NULL AFTER `otp`;
-- Add student_criteria_ratings table to track individual student ratings for each criteria
CREATE TABLE `student_criteria_ratings` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `evaluation_id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `criteria_id` int(30) NOT NULL,
  `faculty_id` int(30) NOT NULL,
  `subject_id` int(30) NOT NULL,
  `academic_id` int(30) NOT NULL,
  `rating` decimal(4,2) NOT NULL DEFAULT 0.00,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `evaluation_id` (`evaluation_id`),
  KEY `student_id` (`student_id`),
  KEY `criteria_id` (`criteria_id`),
  KEY `faculty_id` (`faculty_id`),
  KEY `subject_id` (`subject_id`),
  KEY `academic_id` (`academic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
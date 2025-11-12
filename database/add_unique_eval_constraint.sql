-- Ensure one evaluation per student/teacher/subject/restriction per academic term
ALTER TABLE `evaluation_list`
  ADD UNIQUE KEY `uniq_student_eval`
  (`student_id`,`academic_id`,`restriction_id`,`subject_id`,`faculty_id`);

-- Helpful supporting indexes
ALTER TABLE `evaluation_list`
  ADD INDEX `idx_student_acad_restr` (`student_id`,`academic_id`,`restriction_id`),
  ADD INDEX `idx_faculty_subject_acad` (`faculty_id`,`subject_id`,`academic_id`);

-- Speed up answers lookups
ALTER TABLE `evaluation_answers`
  ADD INDEX `idx_eval_question` (`evaluation_id`,`question_id`);

# Faculty Evaluation System Database Schema

## Tables

### evaluation_list
Stores the main evaluation records submitted by students.

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| student_id | int | Foreign key to student_list table |
| academic_id | int | Foreign key to academic_year_list table |
| class_id | int | Foreign key to class_list table |
| subject_id | int | Foreign key to subject_list table |
| faculty_id | int | Foreign key to faculty_list table |
| restriction_id | int | Foreign key to restriction_list table |
| date_taken | datetime | When the evaluation was submitted |
| comment | text | Optional comment from the student |

### evaluation_answers
Stores individual question answers for each evaluation.

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| evaluation_id | int | Foreign key to evaluation_list table |
| question_id | int | Foreign key to question_list table |
| rate | int | Rating value (1-5) |

### student_criteria_ratings
Stores aggregated ratings by criteria for each student evaluation.

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| evaluation_id | int | Foreign key to evaluation_list table |
| student_id | int | Foreign key to student_list table |
| criteria_id | int | Foreign key to criteria_list table |
| faculty_id | int | Foreign key to faculty_list table |
| subject_id | int | Foreign key to subject_list table |
| academic_id | int | Foreign key to academic_year_list table |
| rating | float | Average rating for this criteria (1-5) |

### faculty_list
Stores information about faculty members.

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| id_no | varchar | Faculty ID number |
| firstname | varchar | First name |
| lastname | varchar | Last name |
| email | varchar | Email address |
| password | varchar | Hashed password |
| avatar | text | Profile image path |
| date_created | datetime | Account creation date |

### student_list
Stores information about students.

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| id_no | varchar | Student ID number |
| firstname | varchar | First name |
| lastname | varchar | Last name |
| class_id | int | Foreign key to class_list table |
| avatar | text | Profile image path |
| email | varchar | Email address |
| password | varchar | Hashed password |
| date_created | datetime | Account creation date |

### class_list
Stores information about class sections.

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| curriculum | varchar | Curriculum name |
| level | varchar | Class level |
| section | varchar | Section name |
| status | tinyint | Status flag |

### subject_list
Stores information about subjects.

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| code | varchar | Subject code |
| subject | varchar | Subject name |
| description | text | Subject description |
| status | tinyint | Status flag |

### criteria_list
Stores evaluation criteria categories.

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| criteria | varchar | Criteria name |
| order_by | int | Display order |

### question_list
Stores evaluation questions.

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| academic_id | int | Foreign key to academic_year_list table |
| question | text | Question text |
| order_by | int | Display order |
| criteria_id | int | Foreign key to criteria_list table |

### academic_year_list
Stores academic year periods.

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| year | varchar | Academic year |
| semester | int | Semester number |
| is_default | tinyint | Default flag |
| status | tinyint | Status flag |

### restriction_list
Stores evaluation restrictions.

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| academic_id | int | Foreign key to academic_year_list table |
| faculty_id | int | Foreign key to faculty_list table |
| class_id | int | Foreign key to class_list table |
| subject_id | int | Foreign key to subject_list table |

### users
Stores system users (administrators).

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| firstname | varchar | First name |
| lastname | varchar | Last name |
| username | varchar | Username |
| password | varchar | Hashed password |
| avatar | text | Profile image path |
| last_login | datetime | Last login timestamp |
| type | tinyint | User type |
| date_added | datetime | Account creation date |
| date_updated | datetime | Last update timestamp |

### admin_history_logs
Stores system activity logs.

| Column | Type | Description |
|--------|------|-------------|
| id | int | Primary key |
| admin_id | int | Foreign key to users table |
| admin_name | varchar | Admin name |
| action_type | varchar | Type of action performed |
| action_description | text | Description of the action |
| timestamp | datetime | When the action occurred |
| ip_address | varchar | IP address |
| user_agent | text | Browser user agent |
| session_id | varchar | PHP session ID |
| target_table | varchar | Affected database table |
| target_id | int | ID of affected record |
| old_values | text | JSON of previous values |
| new_values | text | JSON of new values |
-- Add Sample SHS Subjects based on the class program data
-- This will help test the SHS subject management system

-- Core Subjects (Grade 11)
INSERT INTO subject_list (code, subject, description) VALUES 
('FIL-CORE-11', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino', 'Core subject focusing on Filipino communication and research skills'),
('ENG-CORE-11', 'Oral Communication in Context', 'Core subject developing oral communication skills in various contexts'),
('MATH-CORE-11', 'General Mathematics', 'Core mathematics subject covering fundamental mathematical concepts'),
('SCI-CORE-11', 'Earth and Life Science', 'Core science subject exploring earth processes and life systems'),
('PE-CORE-11', 'Physical Education and Health', 'Core subject promoting physical fitness and health awareness'),
('UCSP-CORE-11', 'Understanding Culture, Society and Politics', 'Core subject examining cultural, social and political concepts');

-- Core Subjects (Grade 12)
INSERT INTO subject_list (code, subject, description) VALUES 
('FIL-CORE-12', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 'Advanced Filipino reading and research skills'),
('ENG-CORE-12', 'Reading and Writing Skills', 'Advanced English reading and writing competencies'),
('MATH-CORE-12', 'Statistics and Probability', 'Core mathematics focusing on statistical analysis and probability'),
('SCI-CORE-12', 'Physical Science', 'Core science subject covering physics and chemistry concepts'),
('PE-CORE-12', 'Physical Education and Health', 'Advanced physical education and health concepts'),
('PHIL-CORE-12', 'Introduction to the Philosophy of the Human Person', 'Core subject exploring philosophical concepts about human nature');

-- STEM Subjects (Grade 11)
INSERT INTO subject_list (code, subject, description) VALUES 
('MATH-STEM-11', 'Pre-Calculus', 'Advanced mathematics preparing for calculus concepts'),
('CHEM-STEM-11', 'General Chemistry 1', 'Fundamental chemistry concepts and laboratory work'),
('PHYS-STEM-11', 'General Physics 1', 'Basic physics principles and applications'),
('BIO-STEM-11', 'General Biology 1', 'Introduction to biological systems and processes');

-- STEM Subjects (Grade 12)
INSERT INTO subject_list (code, subject, description) VALUES 
('MATH-STEM-12', 'Basic Calculus', 'Introduction to differential and integral calculus'),
('CHEM-STEM-12', 'General Chemistry 2', 'Advanced chemistry concepts and laboratory techniques'),
('PHYS-STEM-12', 'General Physics 2', 'Advanced physics principles and applications'),
('BIO-STEM-12', 'General Biology 2', 'Advanced biological concepts and laboratory work');

-- ABM Subjects (Grade 11)
INSERT INTO subject_list (code, subject, description) VALUES 
('ACC-ABM-11', 'Fundamentals of Accountancy, Business and Management 1', 'Basic accounting and business management principles'),
('ECON-ABM-11', 'Applied Economics', 'Economic principles and their real-world applications'),
('BUS-ABM-11', 'Business Mathematics', 'Mathematical applications in business contexts'),
('ENT-ABM-11', 'Entrepreneurship', 'Introduction to entrepreneurial concepts and practices');

-- ABM Subjects (Grade 12)
INSERT INTO subject_list (code, subject, description) VALUES 
('ACC-ABM-12', 'Fundamentals of Accountancy, Business and Management 2', 'Advanced accounting and business management concepts'),
('BUS-ABM-12', 'Business Ethics and Social Responsibility', 'Ethical considerations in business operations'),
('ORG-ABM-12', 'Organization and Management', 'Principles of organizational structure and management'),
('MKT-ABM-12', 'Principles of Marketing', 'Marketing fundamentals and strategies');

-- HUMSS Subjects (Grade 11)
INSERT INTO subject_list (code, subject, description) VALUES 
('PHIL-HUMSS-11', 'Introduction to the Philosophy of the Human Person', 'Philosophical exploration of human nature and existence'),
('SOC-HUMSS-11', 'Disciplines and Ideas in the Social Sciences', 'Overview of various social science disciplines'),
('HIST-HUMSS-11', 'Philippine Politics and Governance', 'Study of Philippine political systems and governance'),
('PSY-HUMSS-11', 'Understanding Culture, Society and Politics', 'Analysis of cultural, social and political interactions');

-- HUMSS Subjects (Grade 12)
INSERT INTO subject_list (code, subject, description) VALUES 
('PHIL-HUMSS-12', 'Creative Writing / Malikhaing Pagsulat', 'Development of creative writing skills in various genres'),
('SOC-HUMSS-12', 'Disciplines and Ideas in the Applied Social Sciences', 'Application of social science concepts to real-world problems'),
('HIST-HUMSS-12', 'Community Engagement, Solidarity and Citizenship', 'Active citizenship and community involvement'),
('PSY-HUMSS-12', 'Trends, Networks and Critical Thinking in the 21st Century', 'Critical analysis of contemporary trends and networks');

-- GAS Subjects (Grade 11)
INSERT INTO subject_list (code, subject, description) VALUES 
('HUM-GAS-11', 'Humanities 1', 'Introduction to humanities disciplines and perspectives'),
('SOC-GAS-11', 'Applied Social Sciences', 'Practical applications of social science concepts'),
('SCI-GAS-11', 'Disaster Readiness and Risk Reduction', 'Disaster preparedness and risk management strategies'),
('TECH-GAS-11', 'Media and Information Literacy', 'Critical evaluation and use of media and information');

-- GAS Subjects (Grade 12)
INSERT INTO subject_list (code, subject, description) VALUES 
('HUM-GAS-12', 'Humanities 2', 'Advanced humanities concepts and applications'),
('SOC-GAS-12', 'Filipino sa Piling Larangan', 'Specialized Filipino language applications'),
('SCI-GAS-12', 'Environmental Science', 'Study of environmental systems and sustainability'),
('TECH-GAS-12', 'Empowerment Technologies', 'Technology applications for empowerment and productivity');

-- TVL Subjects (Grade 11)
INSERT INTO subject_list (code, subject, description) VALUES 
('ICT-TVL-11', 'Computer Programming', 'Introduction to programming concepts and languages'),
('COOK-TVL-11', 'Cookery', 'Basic culinary skills and food preparation techniques'),
('ELEC-TVL-11', 'Electrical Installation and Maintenance', 'Basic electrical systems and maintenance'),
('AUTO-TVL-11', 'Automotive Servicing', 'Basic automotive repair and maintenance skills');

-- TVL Subjects (Grade 12)
INSERT INTO subject_list (code, subject, description) VALUES 
('ICT-TVL-12', 'Computer Systems Servicing', 'Advanced computer hardware and software maintenance'),
('COOK-TVL-12', 'Food and Beverage Services', 'Advanced food service and hospitality skills'),
('ELEC-TVL-12', 'Electronics', 'Advanced electronics systems and troubleshooting'),
('AUTO-TVL-12', 'Automotive Technology', 'Advanced automotive systems and diagnostics');

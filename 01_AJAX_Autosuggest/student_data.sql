use internship;


create table student
(
    studentname varchar(20) NOT NULL,
    email varchar(20) NOT NULL UNIQUE,
    contact varchar(15) NOT NULL,
    mode enum('online', 'onsite', 'hybrid') NOT NULL
);

insert into student(studentname, email, contact, mode) values
('Payal joshi', 'payalrjoshi26@gmail.com', '9876543210', 'onsite'),
('Priya mehta', 'priya46@email.com', '9876543211', 'hybrid'),
('Nitanshi chavda', 'nitu45@gmail.com', '9876543212', 'online'),
('Dharmik Paramar', 'dp6728@gmail.com', '8876543213', 'onsite'),
('Karan joshi', 'karan987@gmail.com', '7876543214', 'hybrid'),
('Radhika joshi', 'radhika12@gmail.com', '9876543215', 'onsite'),
('kunal modhvadiya', 'krun75@gmail.com', '9876543216', 'online'),
('Neha rathod', 'nehar456@gmail.com', '9876543217', 'hybrid'),
('Anjali mehta', 'amehta2308@gmail.com', '7876543218', 'onsite'),
('Pooja odedra', 'poojo08@gmail.com', '6876543219', 'online');
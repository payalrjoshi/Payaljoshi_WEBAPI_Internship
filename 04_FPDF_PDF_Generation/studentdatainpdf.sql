use fpdf;

CREATE TABLE receipt (
  rno varchar(8) NOT NULL,
  rdate varchar(10) NOT NULL,
  stud_id varchar(15) NOT NULL,
  stud_nm varchar(50) NOT NULL,
  ccode varchar(3) NOT NULL,
  cname varchar(50) NOT NULL,
  amt int(5) NOT NULL,
  pay_method varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO receipt (rno, rdate, stud_id, stud_nm, ccode, cname, amt, pay_method) VALUES
('2020041', '24/10/2020', '2K19DCE013', 'Krupal Gajendra Vyas', 'd3s', 'Diploma Computer Engg Sem 3', 2000, 'By Cash'),
('2020042', '03/11/2020', '2K20DCE025', 'Ashish Dilipbhai Thanki', 'd1s', 'Diploma Computer Engg Sem 1', 2000, 'By Cash'),
('2020043', '10/11/2020', '2K19DCE008', 'Ronit Kamleshbhai Motivaras', 'd3s', 'Diploma Computer Engg Sem 3', 2500, 'By Cash'),
('2020044', '11/11/2020', '2K20DCE023', 'Sumit  Amar', 'd1s', 'Diploma Computer Engg Sem 1', 1500, 'NEFT Transfer'),
('2020045', '12/11/2020', '2K20DCE019', 'Riya Jitesh Desai', 'd1s', 'Diploma Computer Engg Sem 1', 2000, 'NEFT Transfer'),
('2020046', '02/10/2020', '2K20DCE019', 'Riya Jitesh Desai', 'd1s', 'Diploma Computer Engg Sem 1', 2000, 'NEFT Transfer'),
('2020047', '22/11/2020', '2K19DCE001', 'Devam Jagdishbhai Joshi', 'd3s', 'Diploma Computer Engg Sem 3', 4000, 'PhonePe'),
('2020048', '21/11/2020', '2K19BCA002', 'Parth Nileshbhai Lalcheta', 'b3s', 'Bachelor of Computer App Sem 3', 2800, 'Google Pay'),
('2020049', '14/09/2020', '2K20DCE018', 'Tanvi Alkeshbhai Bhadiyadra', 'd1s', 'Diploma Computer Engg Sem 1', 2000, 'By Cash'),
('2020050', '05/12/2020', '2K20BCA005', 'Yash Subhashbhai Kotia', 'b1s', 'Bachelor of Computer App Sem 1', 3000, 'By Cash'),
('2020051', '05/12/2020', '2K19DCE003', 'Ashish Jitendrabhai Vaja', 'd3s', 'Diploma Computer Engg Sem 3', 1200, 'By Cash'),
('2020052', '08/12/2020', '2K19DCE006', 'Vruti Vijaybhai Sukhadiya', 'd3s', 'Diploma Computer Engg Sem 3', 2200, 'Google Pay'),
('2020053', '18/12/2020', '2K20BCA004', 'Falguni Pravinbhai Gadher', 'b1s', 'Bachelor of Computer App Sem 1', 1500, 'By Cash'),
('2020054', '25/12/2020', '2K19DCE011', 'Nidhi Gopalbhai Makwana', 'd3s', 'Diploma Computer Engg Sem 3', 4000, 'By Cash'),
('2020055', '26/12/2020', '2K20DCE025', 'Ashish Dilipbhai Thanki', 'd1s', 'Diploma Computer Engg Sem 1', 2000, 'By Cash'),
('2020056', '08/01/2021', '2K20DCE018', 'Tanvi Alkeshbhai Bhadiyadra', 'd1s', 'Diploma Computer Engg Sem 1', 2000, 'By Cash'),
('2020057', '08/01/2021', '2K20DCE020', 'Darshit Satishbhai Vara', 'd1s', 'Diploma Computer Engg Sem 1', 2000, 'By Cash'),
('2020058', '22/11/2021', '2K20BCA006', 'Shyam Ajaybhai Parekh', 'b1s', 'Bachelor of Computer App Sem 1', 1000, 'By Cash'),
('2020059', '20/12/2020', '2K19DCE010', 'Het Rajeshbhai Tank', 'd3s', 'Diploma Computer Engg Sem 3', 3200, 'NEFT Transfer'),
('2020187', '23/07/2023', '2K23DCE095', 'Mihir Girishbhai Fataniya', 'd2s', 'Diploma Computer Engg Sem 2', 5000, 'By Cash'),
('2021060', '23/01/2021', '2K19DCE015', 'Umang  Nandha', 'd3s', 'Diploma Computer Engg Sem 3', 2600, 'By Cash'),
('2021061', '16/02/2021', '2K20DCE021', 'Vivek Umeshbhai Vara', 'd1s', 'Diploma Computer Engg Sem 1', 1000, 'By Cash'),
('2021062', '01/03/2021', '2K20BCA007', 'Kalp Jayesh bhai  Parekh', 'b1s', 'Bachelor of Computer App Sem 1', 3000, 'By Cash'),
('2021063', '01/03/2021', '2K20DCE022', 'Ronak Rajeshbhai Bokhiriya', 'd1s', 'Diploma Computer Engg Sem 1', 1500, 'By Cash'),
('2021064', '01/03/2021', '2K20DCE028', 'Geeta  Odedara', 'd1s', 'Diploma Computer Engg Sem 1', 1800, 'By Cash'),
('2021065', '23/03/2021', '2K19DCE002', 'Jharana Vinod Savjani', 'd4s', 'Diploma Computer Engg Sem 4', 5000, 'By Cash'),
('2021066', '31/03/2021', '2K19DCE001', 'Devam Jagdishbhai Joshi', 'd4s', 'Diploma Computer Engg Sem 4', 2500, 'PhonePe'),
('2021067', '31/03/2021', '2K19DCE006', 'Vruti Vijaybhai Sukhadiya', 'd4s', 'Diploma Computer Engg Sem 4', 2500, 'Google Pay'),
('2021068', '13/04/2021', '2K19DCE008', 'Ronit Kamleshbhai Motivaras', 'd4s', 'Diploma Computer Engg Sem 4', 2500, 'PayTM'),
('2021069', '07/04/2021', '2K19DCE006', 'Vruti Vijaybhai Sukhadiya', 'd4s', 'Diploma Computer Engg Sem 4', 2500, 'Google Pay'),
('2021070', '06/05/2021', '2K20DCE018', 'Tanvi Alkeshbhai Bhadiyadra', 'd2s', 'Diploma Computer Engg Sem 2', 2000, 'Google Pay');

# exam-database



This is a group project developed by myself and 3 others. The project was designed into work for the front end, back end, and "middle end", with the middle being composed of the various algorithms and logic-based tasks. There were 4 use cases required for this project, which were:

1. Instructor can add/delete questions from a question bank.
    -Additionally, they can edit the descriptions/answers or copy the entire thing.
    -The list should be searchable and sort a number of ways. 
2. Instructor can create an exam using questions from the question bank.
    -The instructor should also be able to edit the point values for a question when adding them to an exam.
3. The student should be able to take an exam. Exams are python questions that typically revolve around writing some sort of algorithm.
4. After taking the exam, the instructor reviews it and revises as needed, then releases it so that the student can see the final grade.

My role was the middle end, and my primary contribution was the "grading.php" file, as well as pitching in with some of the backend and front end code. The grading.php file grades a coding question by copying the code, writing it to a .py file, and then running. If it compiles, the student then receives half credit. The rest of the credit is received by syntax checking. The algorithm will also make an attempt to fix an error so that the student will not receive further loss of credit.

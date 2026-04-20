## Results Upload & Processing Guide

This guide explains how subject scores are interpreted, how averages and positions are calculated, and how to upload/import results so the final report cards are accurate and consistent.

### 1) Key Rules (Scored vs Unscored Subjects)

A subject is treated as **unscored** if:

- **CA = 0** and **Exam = 0** for that subject.

When a subject is unscored:

- The subject is **not graded** (grade is shown as `-`).
- The subject is **not included** in the student’s **Average Score**.
- The subject is **not included** when computing the student’s **Position in Class** (overall ranking).
- For per-subject class stats (highest/lowest/position), unscored rows are ignored during import auto-calculation.

Important limitation:

- With this rule, a “real” score of 0/0 cannot be distinguished from “unscored”. If you need to represent a genuine 0/0 attempt, the system will currently treat it as unscored.

### 2) How the System Calculates Average Score

- The student’s **Average Score** is computed as the average of `total` across only the **scored subjects**.
- `total = CA + Exam` for each subject.
- If a student has no scored subjects, Average Score displays as `N/A`.

### 3) How the System Calculates Position in Class (Overall)

- Position in Class is calculated per **Class + Term + Session**.
- Each student’s ranking score is their **Average Score** (as defined above: only scored subjects).
- Students are sorted by that average, highest first.
- The list is then assigned positions 1, 2, 3, ...

### 4) Uploading Results Manually (Teacher Entry)

For each subject:

- Enter CA and Exam according to your class category limits.
- If the student did not take the subject / the score should not count, set **CA = 0** and **Exam = 0**.
- For scored subjects, the grade is computed from `total`.

Best practice:

- Avoid entering Highest/Lowest/Position manually unless you’re intentionally overriding the system’s statistics.

### 5) Uploading Results by Import (CSV/Excel)

General rules:

- Use the correct headings required by the import template you’re using.
- Ensure the `student_number` matches the student’s `std_number` in the system and that the student is in the selected class.
- CA/Exam values must be numeric and within the valid range for the class category:
  - Kindergarten: CA max 50, Exam max 50
  - Primary: CA max 40, Exam max 60
  - JSS: CA max 60, Exam max 40
  - SSS: CA max 30, Exam max 70

For subject class statistics columns (if present in your sheet):

- If you leave `highest_in_class`, `lowest_in_class`, and `position` empty/0, the system will compute them after the import.
- Unscored rows (CA=0 and Exam=0) are ignored for those computations.

### 6) Quick Checklist Before Publishing/Printing

- Confirm every “missing/unoffered” subject is entered as **0 / 0** (so it does not affect averages and rankings).
- Confirm every scored subject has at least one of CA/Exam non-zero.
- Confirm the correct Term and Session were used.
- Confirm attendance fields are populated correctly (school_opened, times_present, times_absent).


<?php
class Student
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function addStudent(array $data): bool
    {
        $stmt = $this->conn->prepare(
            'INSERT INTO students (student_id, name, email, phone, course, year, address) VALUES (:student_id, :name, :email, :phone, :course, :year, :address)'
        );

        return $stmt->execute([
            ':student_id' => $data['student_id'],
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':course' => $data['course'],
            ':year' => $data['year'],
            ':address' => $data['address'],
        ]);
    }

    public function updateStudent(int $id, array $data): bool
    {
        $stmt = $this->conn->prepare(
            'UPDATE students SET name = :name, email = :email, phone = :phone, course = :course, year = :year, address = :address WHERE id = :id'
        );

        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':course' => $data['course'],
            ':year' => $data['year'],
            ':address' => $data['address'],
        ]);
    }

    public function deleteStudent(int $id): bool
    {
        $stmt = $this->conn->prepare('DELETE FROM students WHERE id = :id');

        return $stmt->execute([':id' => $id]);
    }

    public function getStudents(?string $search = null): array
    {
        if ($search) {
            $stmt = $this->conn->prepare(
                'SELECT * FROM students WHERE name LIKE :search OR email LIKE :search OR student_id LIKE :search ORDER BY created_at DESC'
            );
            $stmt->execute([':search' => '%' . $search . '%']);

            return $stmt->fetchAll();
        }

        return $this->conn->query('SELECT * FROM students ORDER BY created_at DESC')->fetchAll();
    }

    public function getStudentById(int $id): ?array
    {
        $stmt = $this->conn->prepare('SELECT * FROM students WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $student = $stmt->fetch();

        return $student ?: null;
    }

    public function studentIdExists(string $studentId): bool
    {
        $stmt = $this->conn->prepare('SELECT COUNT(*) FROM students WHERE student_id = :student_id');
        $stmt->execute([':student_id' => $studentId]);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function countStudents(): int
    {
        return (int) $this->conn->query('SELECT COUNT(*) FROM students')->fetchColumn();
    }

    public function getRecentStudents(int $limit = 5): array
    {
        $stmt = $this->conn->prepare('SELECT * FROM students ORDER BY created_at DESC LIMIT :limit');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}

<?php
$student = $student ?? [
    'student_id' => '',
    'name' => '',
    'email' => '',
    'phone' => '',
    'course' => '',
    'year' => '',
    'address' => '',
];
$isEdit = $isEdit ?? false;
?>
<div class="row g-3">
    <?php if (!$isEdit): ?>
        <div class="col-md-6">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="student_id" name="student_id" value="<?= e($student['student_id']); ?>" required>
        </div>
    <?php else: ?>
        <div class="col-md-6">
            <label class="form-label">Student ID</label>
            <input type="text" class="form-control" value="<?= e($student['student_id']); ?>" disabled>
        </div>
    <?php endif; ?>
    <div class="col-md-6">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= e($student['name']); ?>" required>
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= e($student['email']); ?>" required>
    </div>
    <div class="col-md-6">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?= e($student['phone']); ?>" minlength="10" maxlength="15" required>
    </div>
    <div class="col-md-6">
        <label for="course" class="form-label">Course</label>
        <input type="text" class="form-control" id="course" name="course" value="<?= e($student['course']); ?>" required>
    </div>
    <div class="col-md-6">
        <label for="year" class="form-label">Year</label>
        <input type="number" class="form-control" id="year" name="year" value="<?= e((string) $student['year']); ?>" min="1" max="5" required>
    </div>
    <div class="col-12">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" rows="3" required><?= e($student['address']); ?></textarea>
    </div>
</div>

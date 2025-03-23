<?php
session_start();
require '../../config/database.php';

$db = new Database();
$conn = $db->connect();

// Fetch colleges
$stmt = $conn->prepare("SELECT college_id, college_name FROM colleges");
$stmt->execute();
$colleges = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch departments
$stmt = $conn->prepare("SELECT department_id, department_name FROM departments");
$stmt->execute();
$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $college_id = isset($_POST['college_id']) && !empty($_POST['college_id']) ? $_POST['college_id'] : null;
    $department_id = isset($_POST['department_id']) && !empty($_POST['department_id']) ? $_POST['department_id'] : null;
    $faculty_id = isset($_POST['faculty_id']) && !empty($_POST['faculty_id']) ? $_POST['faculty_id'] : null;

    try {
        $query = "INSERT INTO users (username, password_hash, email, first_name, last_name, role_id";

        // Dynamically add college_id or department_id if available
        if ($college_id !== null) {
            $query .= ", college_id";
        }
        if ($department_id !== null) {
            $query .= ", department_id";
        }
        if ($faculty_id !== null) {
            $query .= ", faculty_id";
        }

        $query .= ") VALUES (:username, :password, :email, :first_name, :last_name, :role_id";

        if ($college_id !== null) {
            $query .= ", :college_id";
        }
        if ($department_id !== null) {
            $query .= ", :department_id";
        }
        if ($faculty_id !== null) {
            $query .= ", :faculty_id";
        }
        $query .= ")";

        $stmt = $conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':role_id', $role);

        if ($college_id !== null) {
            $stmt->bindParam(':college_id', $college_id);
        }
        if ($department_id !== null) {
            $stmt->bindParam(':department_id', $department_id);
        }
        if ($faculty_id !== null) {
            $stmt->bindParam(':faculty_id', $faculty_id);
        }

        $stmt->execute();

        $_SESSION['message'] = "Account successfully registered!";
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: register.php");
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Registration</title>
    <!-- Modern UI Framework -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/auth.css">
</head>

<body class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">

    <div class="max-w-md w-full form-container p-8">
        <!-- Logo and Header -->
        <div class="text-center mb-8">
            <div class="flex justify-center">
                <i class="fas fa-graduation-cap text-4xl text-blue-600"></i>
            </div>
            <h2 class="mt-4 text-3xl font-extrabold text-gray-900">Create your account</h2>
            <p class="mt-2 text-sm text-gray-600">Join our academic community</p>
        </div>

        <!-- Step Indicator -->
        <div class="step-indicator mb-8">
            <div class="step active">1</div>
            <div class="flex-1 h-1 bg-gray-300 self-center"></div>
            <div class="step">2</div>
            <div class="flex-1 h-1 bg-gray-300 self-center"></div>
            <div class="step">3</div>
        </div>

        <!-- Registration Form -->
        <form action="" method="POST" id="registrationForm" onsubmit="return validateForm();">
            <!-- Step 1: Account Info -->
            <div id="step1" class="space-y-6">
                <!-- Username Field -->
                <div class="floating-label-group">
                    <input id="username" name="username" type="text" required class="input-field appearance-none rounded-lg relative block w-full px-4 py-3 border placeholder-transparent focus:outline-none focus:ring-blue-500 focus:z-10 text-gray-900" placeholder=" ">
                    <label for="username" class="floating-label">Username</label>
                    <div class="flex items-center mt-1 ml-1">
                        <i class="fas fa-info-circle text-xs text-gray-500 mr-1"></i>
                        <span class="text-xs text-gray-500">Choose a unique username</span>
                    </div>
                </div>

                <!-- First Name Field -->
                <div class="floating-label-group">
                    <input id="first_name" name="first_name" type="text" required class="input-field appearance-none rounded-lg relative block w-full px-4 py-3 border placeholder-transparent focus:outline-none focus:ring-blue-500 focus:z-10 text-gray-900" placeholder=" ">
                    <label for="first_name" class="floating-label">First Name</label>
                    <div class="flex items-center mt-1 ml-1">
                        <i class="fas fa-info-circle text-xs text-gray-500 mr-1"></i>
                        <span class="text-xs text-gray-500">First Name</span>
                    </div>
                </div>

                <!-- Last name Field -->
                <div class="floating-label-group">
                    <input id="last_name" name="last_name" type="text" required class="input-field appearance-none rounded-lg relative block w-full px-4 py-3 border placeholder-transparent focus:outline-none focus:ring-blue-500 focus:z-10 text-gray-900" placeholder=" ">
                    <label for="last_name" class="floating-label">Last Name</label>
                    <div class="flex items-center mt-1 ml-1">
                        <i class="fas fa-info-circle text-xs text-gray-500 mr-1"></i>
                        <span class="text-xs text-gray-500">Last Name</span>
                    </div>
                </div>

                <!-- Email Field -->
                <div class="floating-label-group">
                    <input id="email" name="email" type="email" required class="input-field appearance-none rounded-lg relative block w-full px-4 py-3 border placeholder-transparent focus:outline-none focus:ring-blue-500 focus:z-10 text-gray-900" placeholder=" ">
                    <label for="email" class="floating-label">Email address</label>
                </div>

                <!-- Password Field -->
                <div class="floating-label-group">
                    <input id="password" name="password" type="password" required class="input-field appearance-none rounded-lg relative block w-full px-4 py-3 border placeholder-transparent focus:outline-none focus:ring-blue-500 focus:z-10 text-gray-900" placeholder=" ">
                    <label for="password" class="floating-label">Password</label>
                    <div class="flex items-center mt-1 ml-1">
                        <i class="fas fa-shield-alt text-xs text-gray-500 mr-1"></i>
                        <span class="text-xs text-gray-500">Must be at least 8 characters</span>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button" id="nextToStep2" class="btn-primary group relative w-1/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white focus:outline-none">
                        Next
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>

            <!-- Step 2: Role Selection -->
            <div id="step2" class="space-y-6 hidden">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Select your role</h3>

                <div class="grid grid-cols-1 gap-4">
                    <div class="role-option border rounded-lg p-4 flex items-center" data-role="2">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-user-tie text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-medium">Dean</h4>
                            <p class="text-sm text-gray-500">College administration</p>
                        </div>
                    </div>

                    <div class="role-option border rounded-lg p-4 flex items-center" data-role="3">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <i class="fas fa-chalkboard-teacher text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-medium">Chair</h4>
                            <p class="text-sm text-gray-500">Department management</p>
                        </div>
                    </div>

                    <div class="role-option border rounded-lg p-4 flex items-center" data-role="4">
                        <div class="bg-purple-100 p-3 rounded-full mr-4">
                            <i class="fas fa-book-reader text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-medium">Faculty</h4>
                            <p class="text-sm text-gray-500">Teaching and research</p>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="role" id="selectedRole">

                <div class="flex justify-between">
                    <button type="button" id="backToStep1" class="group relative w-1/3 flex justify-center py-2 px-4 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back
                    </button>
                    <button type="button" id="nextToStep3" class="btn-primary group relative w-1/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white focus:outline-none">
                        Next
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>

            <!-- Step 3: College/Department Selection -->
            <div id="step3" class="space-y-6 hidden">
                <!-- Dean Dropdown - Only shown when role is Dean -->
                <div id="collegeSelect" class="hidden">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Select your college</h3>
                    <div class="floating-label-group">
                        <select name="college_id" class="input-field appearance-none rounded-lg relative block w-full px-4 py-3 border focus:outline-none focus:ring-blue-500 focus:z-10 text-gray-900">
                            <option value="">Select a college</option>
                            <?php foreach ($colleges as $college): ?>
                                <option value="<?= $college['college_id'] ?>"><?= $college['college_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Chair Dropdown - Only shown when role is Chair -->
                <!-- Chair Dropdown - Only shown when role is Chair -->
                <div id="deptSelect" class="hidden">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Select your department</h3>
                    <div class="floating-label-group">
                        <select name="department_id" id="department_id" class="input-field appearance-none rounded-lg relative block w-full px-4 py-3 border focus:outline-none focus:ring-blue-500 focus:z-10 text-gray-900">
                            <option value="">Select a department</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['department_id'] ?>"><?= $dept['department_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Faculty - Department selection needed -->
                <div id="facultyMessage" class="hidden">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Select your department</h3>
                    <div class="floating-label-group mb-4">
                        <select name="department_id" id="faculty_department" class="input-field appearance-none rounded-lg relative block w-full px-4 py-3 border focus:outline-none focus:ring-blue-500 focus:z-10 text-gray-900">
                            <option value="">Select a department</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['department_id'] ?>"><?= $dept['department_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-500"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-gray-900">Faculty Account</h3>
                                <div class="mt-2 text-sm text-gray-500">
                                    <p>Select the department you belong to. After registration, your department chair can assign you to specific courses.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between">
                    <button type="button" id="backToStep2" class="group relative w-1/3 flex justify-center py-2 px-4 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back
                    </button>
                    <button type="submit" class="btn-primary group relative w-2/3 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white focus:outline-none">
                        Complete Registration
                        <i class="fas fa-user-plus ml-2"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Sign In Link -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Already have an account?
                <a href="login.php" class="font-medium text-blue-600 hover:text-blue-500">
                    Sign in
                </a>
            </p>
        </div>
    </div>

    <script>
        // Navigation between steps
        document.getElementById('nextToStep2').addEventListener('click', function() {
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');

            // Fix: First store the element, then modify it
            const activeStep = document.querySelector('.step.active');
            if (activeStep) {
                activeStep.classList.remove('active');
                activeStep.classList.add('completed');
            }

            document.querySelectorAll('.step')[1].classList.add('active');
        });

        document.getElementById('backToStep1').addEventListener('click', function() {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');

            // Fix: Better handling of class changes
            document.querySelectorAll('.step')[1].classList.remove('active');
            const firstStep = document.querySelectorAll('.step')[0];
            firstStep.classList.remove('completed');
            firstStep.classList.add('active');
        });

        document.getElementById('nextToStep3').addEventListener('click', function() {
            // Validate that a role is selected
            if (!document.getElementById('selectedRole').value) {
                alert('Please select a role to continue');
                return;
            }

            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step3').classList.remove('hidden');

            // Fix: Better handling of class changes
            const activeStep = document.querySelectorAll('.step')[1];
            activeStep.classList.remove('active');
            activeStep.classList.add('completed');
            document.querySelectorAll('.step')[2].classList.add('active');

            // Show the appropriate fields based on role
            const role = document.getElementById('selectedRole').value;

            // Reset required attributes
            document.querySelector('select[name="college_id"]').removeAttribute('required');
            document.getElementById('department_id').removeAttribute('required');
            document.getElementById('faculty_department').removeAttribute('required');

            if (role === '2') { // Dean
                document.getElementById('collegeSelect').classList.remove('hidden');
                document.getElementById('deptSelect').classList.add('hidden');
                document.getElementById('facultyMessage').classList.add('hidden');
                // Set required for visible elements
                document.querySelector('select[name="college_id"]').setAttribute('required', 'required');
            } else if (role === '3') { // Chair
                document.getElementById('deptSelect').classList.remove('hidden');
                document.getElementById('collegeSelect').classList.add('hidden');
                document.getElementById('facultyMessage').classList.add('hidden');
                // Set required for visible elements
                document.getElementById('department_id').setAttribute('required', 'required');
            } else if (role === '4') { // Faculty
                document.getElementById('facultyMessage').classList.remove('hidden');
                document.getElementById('collegeSelect').classList.add('hidden');
                document.getElementById('deptSelect').classList.add('hidden');
                // Set required for visible elements
                document.getElementById('faculty_department').setAttribute('required', 'required');
            }
        });

        document.getElementById('backToStep2').addEventListener('click', function() {
            document.getElementById('step3').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');

            // Fix: Better handling of class changes
            document.querySelectorAll('.step')[2].classList.remove('active');
            const secondStep = document.querySelectorAll('.step')[1];
            secondStep.classList.remove('completed');
            secondStep.classList.add('active');
        });

        // Role selection
        const roleOptions = document.querySelectorAll('.role-option');
        roleOptions.forEach(option => {
            option.addEventListener('click', function() {
                roleOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('selectedRole').value = this.dataset.role;
            });
        });

        // Password visibility toggle
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }
        // Form validation
        function validateForm() {
            const role = document.getElementById('selectedRole').value;
            if (!role) {
                alert('Please select a role');
                return false;
            }

            if (role === '2') { // Dean
                const collegeId = document.querySelector('select[name="college_id"]').value;
                if (!collegeId) {
                    alert('Please select a college');
                    return false;
                }
            } else if (role === '3') { // Chair
                const departmentId = document.querySelector('select[name="department_id"]').value;
                if (!departmentId) {
                    alert('Please select a department');
                    return false;
                }
            } else if (role === '4') { // Faculty
                const facultyDepartmentId = document.getElementById('faculty_department').value;
                if (!facultyDepartmentId) {
                    alert('Please select a department');
                    return false;
                }
            }

            return true;
        }

        // Display any PHP errors/messages
        <?php if (isset($_SESSION['error'])): ?>
            alert('<?php echo $_SESSION['error']; ?>');
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </script>
</body>

</html>
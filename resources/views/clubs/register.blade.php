@extends('layouts.app')

@section('title', 'Optic Clubs - Register Clubs')

@section('content')
    @vite('resources/css/styles.css')
    {{-- Flash Message Display --}}
@if(session('success'))
    <div class="alert alert-success" style="color: green; padding: 10px; background-color: #e1f8e3; border: 1px solid #d4edda; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" style="color: red; padding: 10px; background-color: #f8d7da; border: 1px solid #f5c6cb; margin-bottom: 15px;">
        {{ session('error') }}
    </div>
@endif

    <style>
        #bannerdi {
            background: linear-gradient(rgba(0,0,0,0.5), #e9f0f194), url('{{ asset('images/create club 2.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }
    </style>
<script src="https://js.stripe.com/v3/"></script>

    <section id="bannerdi">
        <div class="navbar">
            <br><br><br><br>
        </div>
        <div class="hero">
            <h1>Register Clubs</h1>
        </div>
        <div class="hometextbtn">
            <a href="#ex"><span>Explore</span></a>
        </div>
    </section>

    <div id="ex"></div>

    <div class="form-container">
        <h2>CLUB FORM</h2>

        <form method="POST" action="{{ route('clubs.store') }}" id="clubForm" enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf
            
            <!-- Club Name -->
            <label for="clubName">Club Name:</label>
            <input type="text" id="clubName" name="clubName" required pattern=".{3,50}" title="Club name should be between 3 to 50 characters.">
            <br><br>

            <!-- Main Picture Upload -->
            <label for="main_image">Upload Club Image:</label>
            <label for="main_image">(Accepted file types: jpeg, png, jpg, gif.)</label>
            
            <input type="file" id="main_image" name="main_image" accept="image/*" required onchange="previewImage(event)">
            <img id="mainPicturePreview" alt="Main Picture Preview" style="display:none; width:100px; height:auto; margin-top:10px;">
            <br>
            <br>

            <!-- Club Description -->
            <label for="clubDescription">Club Description:</label>
            <textarea id="clubDescription" name="clubDescription" rows="4" required minlength="10" maxlength="500" title="Club description should be between 10 to 500 characters."></textarea>
            <br>

            <!-- Club Size -->
            <label for="clubSize">Club Size:</label>
            <select id="clubSize" name="clubSize" required>
                <option value="small">Small (10-20 members)</option>
                <option value="medium">Medium (30-50 members)</option>
                <option value="large">Large (50+ members)</option>
            </select>
            <br>
            <br>

            <!-- Amount to Pay -->
            <p id="amountToPay">Amount to Pay: LKR 0</p>

            <!-- Hidden Payment Field -->
            <input type="hidden" id="payment" name="payment" value="0">

            <!-- Club Type -->
            <label>Club Type:</label>
            <div>
                <label for="physical">Physical</label>
                <input type="radio" id="physical" name="clubType" value="physical" required>
                <label for="nonPhysical">Non-Physical</label>
                <input type="radio" id="nonPhysical" name="clubType" value="non-physical" required>
            </div>
            <br>

            <!-- Monthly Practice Timetable -->
            <label>Monthly Practice Timetable :</label>
            <table id="timetable-table">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="timetable[0][day]" placeholder="e.g., Monday" required pattern="^(Monday|Tuesday|Wednesday|Thursday|Friday|Saturday|Sunday)$" title="Enter a valid day (e.g., Monday)"></td>
                        <td><input type="text" name="timetable[0][time]" placeholder="e.g., 10:00 - 12:00" required pattern="^[0-9]{2}:[0-9]{2}\s*-\s*[0-9]{2}:[0-9]{2}$" title="Enter a valid time range (e.g., 10:00 - 12:00)"></td>
                        <td><button type="button" onclick="addRow()">Add Row</button></td>
                    </tr>
                </tbody>
            </table>
            <br>
            
            <p>Please make sure you make the payment before registering your club.</p>

            <!-- Submit Button -->
            <button type="submit" id="registerButton" class="submit-btn" disabled>Register Club</button>

            
            <br>
            <br>
        </form>

        <div id="payment-section">
            <label>Payment</label>
            <form method="POST" action="{{ route('payment.create') }}" id="paymentForm">
                @csrf
                <input type="hidden" name="amount" id="paymentAmount" value="100"> <!-- Updated dynamically -->
                <input type="hidden" name="description" value="Club Registration">
                <button type="submit" id="payButton" class="submit-btn">Make Payment</button>
            </form>
        </div>
        
        <script>
    // Payment amounts for each club size
    const paymentAmounts = {
        small: 1000,  // $100 for small clubs
        medium: 2500, // $200 for medium clubs
        large: 5000,   // $300 for large clubs
    };

    const clubSizeSelect = document.getElementById("clubSize");
    const amountToPay = document.getElementById("amountToPay");
    const paymentInput = document.getElementById("payment");

    // Update payment amount dynamically
    clubSizeSelect.addEventListener("change", function () {
        const selectedSize = clubSizeSelect.value;
        const amount = paymentAmounts[selectedSize];
        amountToPay.textContent = `Amount to Pay: LKR ${amount}`;
        paymentInput.value = amount; // Update the hidden input
    });

    // Trigger change event on page load to set initial amount
    clubSizeSelect.dispatchEvent(new Event("change"));
</script>

<script>
    // Save form data to localStorage
    function saveFormData() {
        const formData = {};
        const inputs = document.querySelectorAll('#clubForm input, #clubForm textarea, #clubForm select');

        inputs.forEach(input => {
            if (input.type === 'radio') {
                formData[input.name] = document.querySelector(`input[name="${input.name}"]:checked`)?.value || '';
            } else {
                formData[input.name] = input.value;
            }
        });

        localStorage.setItem('clubFormData', JSON.stringify(formData));
    }

    // Restore form data from localStorage
    function restoreFormData() {
        const savedData = localStorage.getItem('clubFormData');
        if (savedData) {
            const formData = JSON.parse(savedData);
            const inputs = document.querySelectorAll('#clubForm input, #clubForm textarea, #clubForm select');

            inputs.forEach(input => {
                if (input.type === 'radio') {
                    if (formData[input.name] === input.value) {
                        input.checked = true;
                    }
                } else {
                    input.value = formData[input.name] || '';
                }
            });

            // Trigger change event for dynamic fields like clubSize
            document.getElementById('clubSize').dispatchEvent(new Event('change'));
        }
    }

    // Remove form data from localStorage after successful submission
    function clearFormData() {
        localStorage.removeItem('clubFormData');
    }

    // Save form data on input changes
    const formInputs = document.querySelectorAll('#clubForm input, #clubForm textarea, #clubForm select');
    formInputs.forEach(input => {
        input.addEventListener('input', saveFormData);
        input.addEventListener('change', saveFormData);
    });

    // Restore data on page load
    window.addEventListener('load', restoreFormData);

    // Clear form data on successful submission
    document.getElementById('clubForm').addEventListener('submit', clearFormData);
</script>


        <script>
            let rowIndex = 1;
            
            function addRow() {
                const table = document.getElementById('timetable-table').getElementsByTagName('tbody')[0];
                const newRow = table.insertRow();
                newRow.innerHTML = `
                    <td><input type="text" name="timetable[${rowIndex}][day]" placeholder="e.g., Monday" required pattern="^(Monday|Tuesday|Wednesday|Thursday|Friday|Saturday|Sunday)$" title="Enter a valid day (e.g., Monday)"></td>
                    <td><input type="text" name="timetable[${rowIndex}][time]" placeholder="e.g., 10:00 - 12:00" required pattern="^[0-9]{2}:[0-9]{2} - [0-9]{2}:[0-9]{2}$" title="Enter a valid time range (e.g., 10:00 - 12:00)"></td>
                    <td><button type="button" onclick="removeRow(this)">Remove</button></td>
                `;
                rowIndex++;
            }
        
            function removeRow(button) {
                const row = button.closest('tr');
                row.remove();
            }
        
            // Image preview function
            function previewImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const output = document.getElementById('mainPicturePreview');
                    output.style.display = 'block';
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        
            // Additional form validation
            function validateForm() {
                const clubName = document.getElementById('clubName').value;
                if (clubName.length < 3 || clubName.length > 50) {
                    alert('Club name must be between 3 and 50 characters.');
                    return false;
                }
                
                const clubDescription = document.getElementById('clubDescription').value;
                if (clubDescription.length < 10 || clubDescription.length > 500) {
                    alert('Club description must be between 10 and 500 characters.');
                    return false;
                }
                
                return true;
            }


            //Payment code
            let paymentSuccess = false; // Flag to track payment status

            document.getElementById('payButton').addEventListener('click', async function (e) {
                e.preventDefault(); // Prevent default button behavior

                const paymentForm = document.getElementById('paymentForm');
                const formData = new FormData(paymentForm);

                try {
                    const response = await fetch(paymentForm.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: formData,
                    });

                    const result = await response.json();

                    if (result.success) {
                        // Redirect to Stripe Checkout
                        window.location.href = result.url;
                    } else {
                        alert(result.message || 'Payment failed. Please try again.');
                    }
                } catch (error) {
                    console.error('Payment error:', error);
                    alert('An error occurred during payment.');
                }
            });

            // Listen for post-checkout redirect success or cancel actions
            window.addEventListener('load', function () {
                const urlParams = new URLSearchParams(window.location.search);
                const paymentStatus = urlParams.get('payment_status');
                const registerButton = document.getElementById('registerButton'); // Correctly define the button element

                // Check payment status and enable the button if payment is successful
                if (paymentStatus === 'success') {
                    alert('Payment completed successfully! You can now submit the form.');
                    registerButton.disabled = false; // Enable the Register Club button
                } else if (paymentStatus === 'cancel') {
                    alert('Payment was canceled. Please try again.');
                }

                // Add event listener to the form to validate payment before submission
                document.querySelector('form').addEventListener('submit', function (event) {
                    if (registerButton.disabled) {
                        event.preventDefault(); // Prevent form submission
                        alert('You must complete the payment to register the club.');
                    }
                });
            });


        </script>
        
    </div>

    <footer style="background:linear-gradient(rgba(0,0,0,0.5),#0066cc), url('{{ asset('images/background.jpeg') }}'); padding: 60px; display: flex; justify-content: space-around;">
        <div class="footer-content" style="display: flex; justify-content: space-around; gap: 20px; width: 100%;">
            <!-- Footer Logo -->
            <div class="footer-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Optic Clubs Logo" class="logo" style="width: 150px; height: auto; margin-right: 100px;">
            </div>

            <!-- Footer Text -->
            <div class="footer-text" style="width: 40%; margin-left: -200px;">
                <h3>Terms & Conditions</h3>
                <p>"Optic is your gateway to a vibrant community of sports enthusiasts, promoting all indoor and outdoor sports..."</p>
            </div>

            <!-- Social Media Links -->
            <div class="social-media">
                <h3>Social Media</h3>
                <a href="#"><img src="{{ asset('images/instagram.jpeg') }}" class="logo1" alt="Instagram" style="width: 30px; height: auto;"></a><br>
                <a href="#"><img src="{{ asset('images/facebook.jpeg') }}" class="logo1" alt="Facebook" style="width: 30px; height: auto;"></a><br>
                <a href="#"><img src="{{ asset('images/twitter.jpeg') }}" class="logo1" alt="Twitter" style="width: 30px; height: auto;"></a><br>
                <a href="#"><img src="{{ asset('images/youtube.jpeg') }}" class="logo1" alt="YouTube" style="width: 30px; height: auto;"></a>
            </div>
        </div>
    </footer>
@endsection

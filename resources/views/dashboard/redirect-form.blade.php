<!DOCTYPE html>
<html>
<head>
    <title>Redirecting...</title>
    <script type="text/javascript">
        // Function to auto-submit the form on page load
        function submitForm() {
            document.getElementById('redirect-form').submit();
        }
        // Wait for the DOM to be fully loaded before submitting the form
        document.addEventListener('DOMContentLoaded', submitForm);
    </script>
</head>
<body>
    <form id="redirect-form" action="{{ route('showStatDetail') }}" method="POST">
        @csrf
        <input type="hidden" name="emiscode" value="{{ $emiscode }}">
        <!-- Optionally include any other hidden fields or CSRF token -->
    </form>
    <p>Redirecting, please wait...</p>
</body>
</html>

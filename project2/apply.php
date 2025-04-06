<?php include 'menu.php'; ?>
<link rel="stylesheet" href="styles/styleapply.css">
<div class="container">
    <h1 class="form-title" text-align="right">Job Application Form</h1>
    <p class="form-subtitle">Please fill out the form below to apply for a position with us.</p>

    <form id="application" method="post" action="process_eoi.php" novalidate="novalidate">
        
    <fieldset class="form-group">
    <legend>Job Reference Number</legend>
    <label for="job_reference"></label>
            <select id="job_reference" name="job_reference" required>
                <option value="WD001">WD001</option>
                <option value="GD002">GD002</option>
                <option value="DE003">DE003</option>
                <option value="BD004">BD004</option>
                <option value="FD005">FD005</option>
            </select>
    </fieldset>

    <fieldset class="form-group">
        <legend>Personal Information</legend>
            <label for="first_name">First Name: <input type="text" id="first_name" name="first_name" maxlength="20" required></label>

            <label for="last_name">Last Name: <input type="text" id="last_name" name="last_name" maxlength="20" required></label>

            <label for="street_address">Street Address: <input type="text" id="street_address" name="street_address" maxlength="40" required></label>

            <label for="suburb_town">Suburb/Town: <input type="text" id="suburb_town" name="suburb_town" maxlength="40" required></label>

            <label for="state">State:</label>
            <select id="state" name="state" required>
                <option value="">Select State</option>
                <option value="VIC">VIC</option>
                <option value="NSW">NSW</option>
                <option value="QLD">QLD</option>
                <option value="NT">NT</option>
                <option value="WA">WA</option>
                <option value="SA">SA</option>
                <option value="TAS">TAS</option>
                <option value="ACT">ACT</option>
            </select>

            <label for="postcode">Postcode: <input type="text" id="postcode" name="postcode" pattern="\d{4}" required></label>

            <label for="email">Email Address: <input type="email" id="email" name="email" required></label>

            <label for="phone">Phone Number: <input type="text" id="phone" name="phone" pattern="\d{10}" required></label>
    </fieldset>

        <fieldset class="form-group checkbox-group">
            <legend>Skills</legend><br>
            <input type="checkbox" id="skill1" name="Skill1" value="HTML">
            <label for="skill1">HTML</label><br>

            <input type="checkbox" id="skill2" name="Skill2" value="CSS">
            <label for="skill2">CSS</label><br>

            <input type="checkbox" id="skill3" name="Skill3" value="JavaScript">
            <label for="skill3">JavaScript</label><br>
        </fieldset>

        <fieldset class="form-group">
            <label for="other_skills">Other Skills:</label>
            <textarea id="other_skills" name="other_skills" rows="3"></textarea>
        </fieldset>
        <button type="submit" class="submit-btn">Submit Application</button>
    </form>
</div>

<?php include 'footer.inc'; ?>


<?php include 'menu.php'; ?>
<link rel="stylesheet" href="vscode/styles/styleapply.css">
<div class="container">
    <h1 class="form-title" text-align="right">Job Application Form</h1>
    <p class="form-subtitle">Please fill out the form below to apply for a position with us.</p>

    <form id="application" method="post" action="process_eoi.php" novalidate="novalidate">     
        <fieldset class="form-section">
            <legend>Job Reference Number</legend>
            <input type="text" name="JobRef" class="input-field" required>
        </fieldset>

        <fieldset class="form-section">
            <legend>Personal Information</legend>
            <label>First Name: <input type="text" name="FirstName" maxlength="20" class="input-field" required></label>
            <label>Last Name: <input type="text" name="LastName" maxlength="20" class="input-field" required></label>
            <label>Address: <input type="text" name="Address" maxlength="40" class="input-field" required></label>
            <label>Suburb/Town: <input type="text" name="Suburb" maxlength="40" class="input-field" required></label>
            <label>State:
                <select name="State" class="input-field">
                    <option value="VIC">VIC</option>
                    <option value="NSW">NSW</option>
                    <option value="QLD">QLD</option>
                    <option value="NT">NT</option>
                    <option value="WA">WA</option>
                    <option value="SA">SA</option>
                    <option value="TAS">TAS</option>
                    <option value="ACT">ACT</option>
                </select>
            </label>
            <label>Postcode: <input type="text" name="Postcode" class="input-field" required></label>
            <label>Email: <input type="email" name="Email" class="input-field" required></label>
            <label>Phone Number: <input type="text" name="Phone" class="input-field" required></label>
        </fieldset>

        <fieldset class="form-section">
            <legend>Skills</legend>
            <label><input type="checkbox" name="Skill1" value="HTML"> HTML</label>
            <label><input type="checkbox" name="Skill2" value="CSS"> CSS</label>
            <label><input type="checkbox" name="Skill3" value="JavaScript"> JavaScript</label>
            <label>Other Skills: <input type="text" name="OtherSkills" class="input-field"></label>
        </fieldset>

        <button type="submit" class="submit-btn">Submit Application</button>
    </form>
</div>

<?php include 'footer.inc'; ?>

<form action="" method="post">
<table align="center" border=0 cellspacing=5>
<tr><td>
    <fieldset id="req">
    <legend>Required information</legend>
    <table border=0>
    <tr><td>

    <label for="f_n">First name:</label></td><td><input id="f_n" type="text" name="first_name" maxlength=10 />
    </td></tr><tr><td>
    <label for="l_n">Last name:</label></td><td><input id="l_n" type="text" name="last_name" maxlength=10 />
    </td></tr><tr><td>
    <label for="nick">Nickname:</label></td><td><input id="nick" type="text" name="nick" maxlength=20 />
    </td></tr><tr><td>
    <label for="email">E-mail:</label></td><td><input id="email" type="text" name="email" maxlength=255 />
    </td></tr><tr><td>
    <label for="tz">Timezone:</label></td><td><select id="tz" name="timezone">
        <optgroup label="Simple">
        <option value="FOO">Foo</option>
        <option value="BAZ">Baz</option>
        <optgroup label="Compound">
        <option value="FOOBAR" selected="selected">FooBar</option>
        </optgroup>
    </select>
    </td></tr><tr><td>
    <label for="country">Country:</label></td><td><select id="country" name="country">
        <optgroup label="Simple">
        <option value="RO">Romania</option>
        <option value="BAZ">Baz</option>
        <optgroup label="Compound">
        <option value="FOOBAR" selected="selected">FooBar</option>
        </optgroup>
    </select>
    </td></tr><tr><td>
    <label for="city">City:</label></td><td><input id="city" type="text" name="city" maxlength=30 />
    </td></tr><tr><td>

    </td></tr>
    </table>
    </fieldset>

</td><td>

    <fieldset id="opt">
    <legend>Optional information</legend>
    <table border=0>
    <tr><td>

    <label for="priv">Public account:</label></td><td><input id="priv" type="checkbox" name="private" checked />
    </td></tr><tr><td>
    <label for="sm">Male</label><br />
    <label for="sf"> Female</label></td><td>
    <input type="radio" name="sex" value="M" id="sm" /><br />
    <input type="radio" name="sex" value="F" id="sf" />
    </td></tr><tr><td>
    <label for="phone">Phone:</label></td><td><input id="phone" type="text" name="phone" maxlength=20 />
    </td></tr><tr><td><label for="bday">Birthdate:</label></td><td><select id="bday" name="birthday">
    <option value='x'>X</option>
    </select>
    </td></tr><tr><td>
    <label for="desc">Description:</label></td><td><textarea name="description" maxlength=100 id="desc" ></textarea>
    </td></tr><tr><td>

    </table>
    </fieldset>

</td></tr></table>

<input type="submit" name="register" value="Register" />
</form>

<!--
    <label for="">FOO:</label></td><td><input id="" type="" name="" maxlength=FOO />
    </td></tr><tr><td>
PASSWORD, SEC_Q and SEC_A on activation
-->

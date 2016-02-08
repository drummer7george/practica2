<!DOCTYPE html>
<html lang="en">
	 
<head>
<meta charset="utf-8" />
 <title>Login</title>
</head>
	 
<body>
	<hr />
	<br />
	<br />
	<br />
	<br />
	<br />

	<center>
<hr />
<h1>Login Usuarios</h1>
 
<form name="form1" method="post" action="checklogin.php">
	 
<label>Nombre:</label>
<input name="username" type="text" id="username" required>
<br><br>
<label>Password:</label>
<input name="password" type="password" id="password" required>
<br><br>
<select name="list" id="list" >
  <option value=1 >Adm. BD</option>
  <option value=2 >Adm. Sistema</option>
  <option value=3 >Usuario</option>
</select>
<br><br>
<input type="submit" name="Submit" value="Entrar">
</form>
<hr />
</center>
<br>
<nav>
                    <ul class="sf-menu" id="nav">
                        <li ><a href="inicio.php">Administracion</a></li>
                    </ul>
                </nav>
            </br>
<footer>
&copy;2014 GBSoft SolutionsGT
</footer>
 
</body>
</html>

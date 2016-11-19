<?php
/*

Cross-site Scripting (XSS) (CWE-79) - Prevention Example

Mitigation:

- Sanitize input and output
- Make sure charset is defined in the output document
- Use of HTTP Headers like X-XSS-Proctection, Content-Security-Policy and setting the HttpOnly flag on cookies.

Reference Links:

- OWASP XSS Prevention Cheat Sheet - https://www.owasp.org/index.php/XSS_(Cross_Site_Scripting)_Prevention_Cheat_Sheet
- OWASP PHP Filters - https://www.owasp.org/index.php/OWASP_PHP_Filters
- htmlspecialchars - https://secure.php.net/manual/en/function.htmlspecialchars.php
- urlencode - https://secure.php.net/manual/en/function.urlencode.php
- HTTP Security Headers - https://www.owasp.org/index.php/OWASP_Secure_Headers_Project#Headers
- Set-Cookie HttpOnly flag - https://www.owasp.org/index.php/HttpOnly

*/

require_once('../lib/sanitize.inc.php');

if(!isset($_GET['search_term'])){
	echo "Submit a search term via the GET parameter search_term";
	exit();
}

?>

<h1>Search results for <?= htmlspecialchars($_GET['search_term'], ENT_QUOTES); ?> </h1>

<a href="<?= urlencode(sanitize_paranoid_string($_GET['search_term']));  ?>">Link</a>

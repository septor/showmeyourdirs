<?php

// -----------------------------------------
// ShowMeYourDirs
// -----------------------------------------

// getcwd() uses the files current directory
$root = getcwd();

// Exclude the unneeded crap, add more if you'd like.
$exclude = array('.', '..');

// Scan the directory, and then sort it alphabetically.
$scan = scandir($root);
sort($scan, SORT_STRING | SORT_FLAG_CASE);

echo "
<html>
	<head>
		<title>Listing the contents of: ".$root."</title>

		<style>
			body, td {
				font: 12px Tahoma;
				background-color: #ffe2b3;
				color: #000;
			}
			td {
				padding: 4px;
			}
			a {
				color: #1f3642;
			}
			a:hover {
				color: #000;
			}
			table {
				width: 100%;
				margin: 0 auto;
				background-color: #1f3642;
			}
			.holder {
				margin: 2px auto;
				max-height: 48%;
				overflow: auto;
				width: 50%;
			}
			.thead, .tfoot {
				background-color: #6d968d;
			}
			.tbody {
				background-color: #b6ccb8;
				padding-left: 10px;
			}
			.tfoot {
				text-align: right;
			}
		</style>
	</head>
	<body>
		<div class='holder'>
			<table cellspacing='1'>
				<tr>
					<td colspan='2' class='thead'>
						<b>Directories</b>
					</td>
				</tr>
				<tr>
					<td colspan='2' class='thead'>
						Name
					</td>
				</tr>
";

// Display all the folders first.
foreach($scan as $idd => $directory)
{
	if(is_dir($directory))
	{
		if(!in_array($directory, $exclude))
		{
			echo "
				<tr>
					<td colspan='2' class='tbody'>
						<a href='".$directory."'>".$directory."</a>
					</td>
				</tr>
			";
		}
	}
}

echo "
			</table>
		</div>
		<div class='holder'>
			<table cellspacing='1'>
				<tr>
					<td colspan='2' class='thead'>
						<b>Files</b>
					</td>
				</tr>
				<tr>
					<td class='thead' style='width: 80%;'>
						Name
					</td>
					<td class='thead'>
						Size <span style='float: right;'>(<b>kilobytes</b>, <i>bytes</i>)</span>
					</td>
				</tr>
";

// Now list all the files.
foreach($scan as $idf => $file)
{
	if(is_file($file))
	{
		if(!in_array($file, $exclude))
		{
			echo "
				<tr>
					<td class='tbody'>
						<a href='".$file."'>".$file."</a>
					</td>
					<td class='tbody' style='text-align: right; padding-right: 10px;'>
						".(filesize($file) > 1024 ? "<b>".round(filesize($file) / 1024)."</b>" : "<i>".filesize($file)."</i>")."
					</td>
				</tr>
			";
		}
	}
}

echo "
			</table>
		</div>
		<table cellspacing='1' style='width: 50%;'>
			<tr>
				<td class='tfoot' colspan='2'>
					powered by <a href='https://github.com/septor/showmeyourdirs'>showmeyourdirs</a>
				</td>
			</tr>
		</table>
	</body>
</html>
";

?>
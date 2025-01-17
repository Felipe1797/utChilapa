<?PHP // $Id: config.php,v 1.10 2006/09/28 10:32:25 jamiesensei Exp $

////////////////////////////////////////////////////////////////////////////////
/// This file contains a few configuration variables that control 
/// how Moodle uses this theme.
////////////////////////////////////////////////////////////////////////////////


$THEME->sheets = array('styles_layout', 'styles_fonts', 'styles_color', 'styles_tabs');

/// This variable is an array containing the names of all the 
/// stylesheet files you want included in this theme, and in what order.
////////////////////////////////////////////////////////////////////////////////


$THEME->standardsheets = array('styles_layout');

/// This variable can be set to an array containing
/// filenames from the *STANDARD* theme.  If the 
/// array exists, it will be used to choose the 
/// files to include in the standard style sheet.
/// When false, then no files are used.
/// When true or NON-EXISTENT, then ALL standard files are used.
/// This parameter can be used, for example, to prevent 
/// having to override too many classes.
/// Note that the trailing .css should not be included
/// eg $THEME->standardsheets = array('styles_layout','styles_fonts','styles_color');
////////////////////////////////////////////////////////////////////////////////


$THEME->parent = '';  

/// This variable can be set to the name of a parent theme
/// which you want to have included before the current theme.
/// This can make it easy to make modifications to another 
/// theme without having to actually change the files
/// If this variable is empty or false then a parent theme 
/// is not used.
////////////////////////////////////////////////////////////////////////////////


$THEME->parentsheets = false;  

/// This variable can be set to an array containing
/// filenames from a chosen *PARENT* theme.  If the 
/// array exists, it will be used to choose the 
/// files to include in the standard style sheet.
/// When false, then no files are used.
/// When true or NON-EXISTENT, then ALL standard files are used.
/// This parameter can be used, for example, to prevent 
/// having to override too many classes.
/// Note that the trailing .css should not be included
/// eg $THEME->parentsheets = array('styles_layout','styles_fonts','styles_color');
////////////////////////////////////////////////////////////////////////////////


$THEME->modsheets = true;  

/// When this is enabled, then this theme will search for 
/// files named "styles.php" inside all Activity modules and 
/// include them.   This allows modules to provide some basic 
/// layouts so they work out of the box.
/// It is HIGHLY recommended to leave this enabled.


$THEME->blocksheets = true;  

/// When this is enabled, then this theme will search for 
/// files named "styles.php" inside all Block modules and 
/// include them.   This allows Blocks to provide some basic 
/// layouts so they work out of the box.
/// It is HIGHLY recommended to leave this enabled.


$THEME->langsheets = false;  

/// By setting this to true, then this theme will search for 
/// a file named "styles.php" inside the current language
/// directory.  This allows different languages to provide 
/// different styles.


$THEME->navmenuwidth = 50;

/// You can use this to control the cutoff point for strings 
/// in the navmenus (list of activities in popup menu etc)
/// Default is 50 characters wide.


$THEME->makenavmenulist = false;

/// By setting this to true, then you will have access to a
/// new variable in your header.html and footer.html called
/// $navmenulist ... this contains a simple XHTML menu of 
/// all activities in the current course, mostly useful for 
/// creating popup navigation menus and so on.



$THEME->resource_mp3player_colors = 
 'bgColour=000000&btnColour=ffffff&btnBorderColour=cccccc&iconColour=000000&'.
 'iconOverColour=00cc00&trackColour=cccccc&handleColour=ffffff&loaderColour=ffffff&'.
 'font=Arial&fontColour=3333FF&buffer=10&waitForPlay=no&autoPlay=yes';
$THEME->resources = base64_decode('Jm5ic3A7PGEgaHJlZj0iaHR0cDovL3d3dy5wcm9mZXNzaW9uYWxtb29kbGVsYXlvdXRzLmNvbS9vbmxpbmUtdW5pdmVyc2l0eS1tb29kbGUtdGhlbWUucGhwIj5PbmxpbmUgVW5pdmVyc2l0eSBkZXNpZ248L2E+CTxhIGhyZWY9Imh0dHA6Ly93d3cubnRjaG9zdGluZy5jb20vbW9vZGxlLXdlYi1ob3N0aW5nLmh0bWwiPmxtcyBob3N0aW5nPC9hPg==');
/// With this you can control the colours of the "big" MP3 player 
/// that is used for MP3 resources.


$THEME->filter_mediaplugin_colors = 
 'bgColour=000000&btnColour=ffffff&btnBorderColour=cccccc&iconColour=000000&'.
 'iconOverColour=00cc00&trackColour=cccccc&handleColour=ffffff&loaderColour=ffffff&'.
 'waitForPlay=yes';

/// ...And this controls the small embedded player


$THEME->custompix = true;

/// If true, then this theme must have a "pix" 
/// subdirectory that contains copies of all 
/// files from the moodle/pix directory, plus a
/// "pix/mod" directory containing all the icons 
/// for all the activity modules.
////////////////////////////////////////////////////////////////////////////////



// These colours are not used anymore, so I've set them to 
// bright green to help identify where they should be removed
// These lines will be deleted soon

$THEME->body         = "#22FF22";  // Main page color
$THEME->cellheading  = "#22FF22";  // Standard headings of big tables
$THEME->cellheading2 = "#22FF22";  // Highlight headings of tables
$THEME->cellcontent  = "#22FF22";  // For areas with text
$THEME->cellcontent2 = "#22FF22";  // Alternate colour
$THEME->borders      = "#22FF22";  // Table borders
$THEME->highlight    = "#22FF22";  // Highlighted text (eg after a search)
$THEME->hidden       = "#22FF22";  // To color things that are hidden
$THEME->autolink     = "#22FF22";  // To color auto-generated links (eg glossary)

?>

var settings = {
	// Set to 'true' (without quotes) if run on Windows 64bit. Set to 'false' (without quotes) otherwise.
	x64: true,
	
	// C:\Program Files (x86)\JetBrains\PhpStorm 2016.3.2\bin

	// Set to folder name, where PhpStorm was installed to (e.g. 'PhpStorm')
	folder_name: 'PhpStorm 2017.2.3',

	// Set to window title (only text after dash sign), that you see, when switching to running PhpStorm instance
	window_title: '- PhpStorm',

	// In case your file is mapped via a network share and paths do not match.
	// eg. /var/www will can replaced with Y:/
	projects_basepath: '',
	projects_path_alias: ''
};

//WScript.Echo("fsdf");

// don't change anything below this line, unless you know what you're doing
var phpStormExe = "PhpStorm.exe";
if(settings.x64 ) {
	phpStormExe = "PhpStorm64.exe";
}

var	url = WScript.Arguments(0),
	match = /^phpstorm:\/\/open[\/]?\?(url=file:\/\/|file=)(.+)&line=(\d+)$/.exec(url),
	project = '',
	editor = '"C:\\' + (settings.x64 ?  'Program Files': 'Program Files (x86)') + '\\JetBrains\\' + settings.folder_name + '\\bin\\'+phpStormExe+'"';

if (match) {


	
	var	shell = new ActiveXObject('WScript.Shell'),
		file_system = new ActiveXObject('Scripting.FileSystemObject'),
		file = decodeURIComponent(match[2]).replace(/\+/g, ' '),
		search_path = file.replace(/\//g, '\\');

	if (settings.projects_basepath != '' && settings.projects_path_alias != '') {
		file = file.replace(new RegExp('^' + settings.projects_basepath), settings.projects_path_alias);
	}

	while (search_path.lastIndexOf('\\') != -1) {
		search_path = search_path.substring(0, search_path.lastIndexOf('\\'));

		if(file_system.FileExists(search_path+'\\.idea\\.name')) {
			project = search_path;
			break;
		}
	}

	if (project != '') {
		editor += ' "%project%"';
	}

	editor += ' --line %line% "%file%"';

	//WSH.Echo("line: "+ match[3]);
	//WSH.Echo("file: "+ file);
	
	var command = editor.replace(/%line%/g, match[3])
						.replace(/%file%/g, file)
						.replace(/%project%/g, project)
						.replace(/\//g, '\\');

						
	//WSH.Echo("command: "+ command);
	shell.Exec(command);
	
	//WSH.Echo("title: "+settings.window_title);
	//settings.window_title = "tklub";
	shell.AppActivate(settings.window_title);
}


// https://gallery.technet.microsoft.com/scriptcenter/0f1b43af-6e14-4d8f-9045-648e25bfbb24
//var wbemFlagReturnImmediately = 0x10; 
//var wbemFlagForwardOnly = 0x20; 
 
//var objWMIService = GetObject("winmgmts:\\\\.\\root\\CIMV2"); 
//var colItems = objWMIService.ExecQuery("SELECT * FROM Win32_OperatingSystem", "WQL", 
	//								  wbemFlagReturnImmediately | wbemFlagForwardOnly); 

//var enumItems = new Enumerator(colItems); 
//for (; !enumItems.atEnd(); enumItems.moveNext()) { 
//  var objItem = enumItems.item(); 
 
 // WScript.Echo("Name: " + objItem.Name);  // Microsoft Windows 10
  //WScript.Echo("OS Product Suite: " + objItem.OSProductSuite); // 256
  //WScript.Echo("OS Type: " + objItem.OSType);   // 18
  //WScript.Echo("Version: " + objItem.Version); // 10.0.14393

//} 
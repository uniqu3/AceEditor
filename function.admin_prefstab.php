if (isset($params['example_syntax'])) {
	cms_userprefs::set_for_user($userid, $this->GetName() . '_example_syntax', $params['example_syntax']);
}
$smarty->assign('startform', $this->CreateFormStart($id, 'savesettings', $returnid));
$smarty->assign('endform', $this->CreateFormEnd());


$smarty->assign('width_input', $this->CreateInputText($id, 'width', cms_userprefs::get_for_user($userid, $this->GetName() . '_width', '80'), 10, 255));
$smarty->assign('height_input', $this->CreateInputText($id, 'height', cms_userprefs::get_for_user($userid, $this->GetName() . '_height', '40'), 10, 255));
// create a IE pref, DONT WANT TO SEE A BR FOR THIS SHIT!
$smarty->assign('enable_ieinput', $this->CreateInputCheckbox($id, 'enable_ie', 1, cms_userprefs::get_for_user($userid, $this->GetName() . '_enable_ie', 0)));

/* mode dropdown */
$modes = array(
	$this->Lang('js') => 'javascript',
	$this->Lang('plain') => 'plain',
	$this->Lang('svg') => 'svg',
	$this->Lang('html') => 'html',
	$this->Lang('css') => 'css',
	$this->Lang('scss') => 'scss',
	$this->Lang('coffee') => 'coffee',
	$this->Lang('json') => 'json',
	$this->Lang('python') => 'python',
	$this->Lang('ruby') => 'ruby',
	$this->Lang('perl') => 'perl',
	$this->Lang('php') => 'php',
	$this->Lang('java') => 'java',
	$this->Lang('csharp') => 'csharp',
	$this->Lang('c_cpp') => 'c_cpp',
	$this->Lang('clojure') => 'clojure',
	$this->Lang('coldfusion') => 'coldfusion',
	$this->Lang('diff') => 'diff',
	$this->Lang('haxe') => 'haxe',
	$this->Lang('latex') => 'latex',
	$this->Lang('lua') => 'lua',
	$this->Lang('markdown') => 'markdown',
	$this->Lang('powershell') => 'powershell',
	$this->Lang('sql') => 'sql',
	$this->Lang('pgsql') => 'pgsql',
	$this->Lang('ocaml') => 'ocaml',
	$this->Lang('textile') => 'textile',
	$this->Lang('groovy') => 'groovy',
	$this->Lang('golang') => 'golang',
	$this->Lang('jsx') => 'jsx',
	$this->Lang('less') => 'less',
	$this->Lang('liquid') => 'liquid',
	$this->Lang('scad') => 'scad',
	$this->Lang('sh') => 'sh',
	$this->Lang('xquery') => 'xquery',
	$this->Lang('yaml') => 'yaml',
	$this->Lang('scala') => 'scala'
);
$smarty->assign('syntax_modeinput', $this->CreateInputDropdown($id, 'mode', $modes, -1, cms_userprefs::get_for_user($userid, $this->GetName() . '_mode', 'html'), 'onchange="this.form.submit()"'));

/* themes */
$themes = array(
    $this->Lang('ambiance') => 'ambiance',
	$this->Lang('chrome') => 'chrome',
	$this->Lang('clouds') => 'clouds',
	$this->Lang('clouds_midnight') => 'clouds_midnight',
	$this->Lang('cobalt') => 'cobalt',
	$this->Lang('crimson_editor') => 'crimson_editor',
	$this->Lang('dawn') => 'dawn',
	$this->Lang('dreamweaver') => 'dreamweaver',
	$this->Lang('eclipse') => 'eclipse',
	$this->Lang('idle_fingers') => 'idle_fingers',
	$this->Lang('kr_theme') => 'kr_theme',
	$this->Lang('merbivore') => 'merbivore',
	$this->Lang('merbivore_soft') => 'merbivore_soft',
	$this->Lang('mono_industrial') => 'mono_industrial',
	$this->Lang('monokai') => 'monokai',
	$this->Lang('pastel_on_dark') => 'pastel_on_dark',
	$this->Lang('solarized_dark') => 'solarized_dark',
	$this->Lang('solarized_light') => 'solarized_light',
	$this->Lang('textmate') => 'textmate',
	$this->Lang('tomorrow') => 'tomorrow',
	$this->Lang('tomorrow_night') => 'tomorrow_night',
	$this->Lang('tomorrow_night_blue') => 'tomorrow_night_blue',
	$this->Lang('tomorrow_night_bright') => 'tomorrow_night_bright',
	$this->Lang('tomorrow_night_eighties') => 'tomorrow_night_eighties',
	$this->Lang('twilight') => 'twilight',
	$this->Lang('vibrant_ink') => 'vibrant_ink'
);
$smarty->assign('themeinput', $this->CreateInputDropdown($id, 'theme', $themes, -1, cms_userprefs::get_for_user($userid, $this->GetName() . '_theme', 'textmate'), 'onchange="this.form.submit()"'));

/* font size */
$fonts = array(
	'10px' => '10px',
	'11px' => '11px',
	'12px' => '12px',
	'14px' => '14px',
	'16px' => '16px',
	'20px' => '20px',
	'24px' => '24px'
);
$smarty->assign('fontsizeinput', $this->CreateInputDropdown($id, 'fontsize', $fonts, -1, cms_userprefs::get_for_user($userid, $this->GetName() . '_fontsize', '12px')));

$smarty->assign('full_lineinput', $this->CreateInputCheckbox($id, 'full_line', 1, cms_userprefs::get_for_user($userid, $this->GetName() . '_full_line', 1)));
$smarty->assign('highlight_activeinput', $this->CreateInputCheckbox($id, 'highlight_active', 1, cms_userprefs::get_for_user($userid, $this->GetName() . '_highlight_active', 1)));
$smarty->assign('show_invisiblesinput', $this->CreateInputCheckbox($id, 'show_invisibles', 1, cms_userprefs::get_for_user($userid, $this->GetName() . '_show_invisibles', 0)));
$smarty->assign('persistent_hscrollinput', $this->CreateInputCheckbox($id, 'persistent_hscroll', 1, cms_userprefs::get_for_user($userid, $this->GetName() . '_persistent_hscroll', 1)));

/* text wrapping */
$soft_wrap = array(
	$this->Lang('off') => 'off',
	$this->Lang('40') => '40,40',
	$this->Lang('80') => '80,80',
	$this->Lang('100') => '100,100',
	$this->Lang('140') => '140,140'
);
$smarty->assign('soft_wrapinput', $this->CreateInputDropdown($id, 'soft_wrap', $soft_wrap, -1, cms_userprefs::get_for_user($userid, $this->GetName() . '_soft_wrap', '80,80')));

$smarty->assign('show_gutterinput', $this->CreateInputCheckbox($id, 'show_gutter', 1, cms_userprefs::get_for_user($userid, $this->GetName() . '_show_gutter', 1)));
$smarty->assign('print_margininput', $this->CreateInputCheckbox($id, 'print_margin', 1, cms_userprefs::get_for_user($userid, $this->GetName() . '_print_margin', 0)));
$smarty->assign('soft_tabinput', $this->CreateInputCheckbox($id, 'soft_tab', 1, cms_userprefs::get_for_user($userid, $this->GetName() . '_soft_tab', 1)));
$smarty->assign('highlight_selectedinput', $this->CreateInputCheckbox($id, 'highlight_selected', 1, cms_userprefs::get_for_user($userid, $this->GetName() . '_highlight_selected', 1)));
$smarty->assign('behaviours_input', $this->CreateInputCheckbox($id, 'enable_behaviors', 1, cms_userprefs::get_for_user($userid, $this->GetName() . '_enable_behaviors', 1)));

$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', $this->Lang('savesettings')));

/* sample content */
$syntax_content = '';
switch (cms_userprefs::get_for_user($userid, $this->GetName() . '_mode', 'html')) {
	case 'html': {
		$syntax_content = <<<EOT
<style type="text/css">
    font-family: Monaco, "Courier New", monospace;
    <h1 style="color:red">Juhu Kinners</h1>
EOT;
		break;
	}
	case 'css': {
		$syntax_content = <<<EOT
    font-family: Monaco, "Courier New", monospace;
}
EOT;
		break;
	}
	case 'javascript': {
		$syntax_content = <<<EOT
        alert(items[i] + "juhu");
}
EOT;
		break;
	}
	case 'plain': {
		$syntax_content = <<<EOT
EOT;
		break;
	}
	case 'svg': {
		$syntax_content = <<<EOT
  width="800" height="600"
  xmlns="http://www.w3.org/2000/svg"
  onload="StartAnimation(evt)">
  <script type="text/ecmascript"><![CDATA[
        hickory  = evt.target.ownerDocument.getElementById("hickory");
        dickory = evt.target.ownerDocument.getElementById("dickory");
        dock = evt.target.ownerDocument.getElementById("dock");
            hickory.setAttribute("display", "");
            hickory.setAttribute("transform", "translate(" + (600+scalefactor*3*-1 ) + ", -144 )");
            dickory.setAttribute("display", "");
            dickory.setAttribute("transform", "translate(" + (-795+scalefactor*2) + ", 0 )");
            dock.setAttribute("display", "");
            dock.setAttribute("transform", "translate(" + (1450+scalefactor*2*-1) + ", 144 )");
        setTimeout("ShowAndGrowElement()", timer_increment)
    fill="#2e3436"
    fill-rule="nonzero"
    stroke-width="3"
    y="0"
    x="0"
    height="600"
    width="800"
    id="rect3590"/>
       style="font-size:144px;font-style:normal;font-variant:normal;font-weight:bold;font-stretch:normal;fill:#000000;fill-opacity:1;stroke:none;font-family:Bitstream Vera Sans;-inkscape-font-specification:Bitstream Vera Sans Bold"
       x="50"
       y="350"
       id="hickory"
       display="none">
       style="font-size:144px;font-style:normal;font-variant:normal;font-weight:bold;font-stretch:normal;fill:#000000;fill-opacity:1;stroke:none;font-family:Bitstream Vera Sans;-inkscape-font-specification:Bitstream Vera Sans Bold"
       x="50"
       y="350"
       id="dickory"
       display="none">
       style="font-size:144px;font-style:normal;font-variant:normal;font-weight:bold;font-stretch:normal;fill:#000000;fill-opacity:1;stroke:none;font-family:Bitstream Vera Sans;-inkscape-font-specification:Bitstream Vera Sans Bold"
       x="50"
       y="350"
       id="dock"
       display="none">
</svg>
EOT;
		break;
	}
	case 'scss': {
		$syntax_content = <<<EOT
}
EOT;
		break;
	}
	case 'coffee': {
		$syntax_content = <<<EOT
    console.log 'qstring' + "qqstring" + '''
    ''' + """
    """
EOT;
		break;
	}
	case 'json': {
		$syntax_content = <<<EOT
 "query": {
  "count": 10,
  "created": "2011-06-21T08:10:46Z",
  "lang": "en-US",
  "results": {
   "photo": [
     "farm": "6",
     "id": "5855620975",
     "isfamily": "0",
     "isfriend": "0",
     "ispublic": "1",
     "owner": "32021554@N04",
     "secret": "f1f5e8515d",
     "server": "5110",
     "title": "7087 bandit cat"
     "farm": "4",
     "id": "5856170534",
     "isfamily": "0",
     "isfriend": "0",
     "ispublic": "1",
     "owner": "32021554@N04",
     "secret": "ff1efb2a6f",
     "server": "3217",
     "title": "6975 rusty cat"
     "farm": "6",
     "id": "5856172972",
     "isfamily": "0",
     "isfriend": "0",
     "ispublic": "1",
     "owner": "51249875@N03",
     "secret": "6c6887347c",
     "server": "5192",
     "title": "watermarked-cats"
     "farm": "6",
     "id": "5856168328",
     "isfamily": "0",
     "isfriend": "0",
     "ispublic": "1",
     "owner": "32021554@N04",
     "secret": "0c1cfdf64c",
     "server": "5078",
     "title": "7020 mandy cat"
     "farm": "3",
     "id": "5856171774",
     "isfamily": "0",
     "isfriend": "0",
     "ispublic": "1",
     "owner": "32021554@N04",
     "secret": "7f5a3180ab",
     "server": "2696",
     "title": "7448 bobby cat"
}
EOT;
		break;
	}
	case 'python': {
		$syntax_content = <<<EOT
        print repr(i), "not a numeric value"  
EOT;
		break;
	}
	case 'php': {
		$syntax_content = <<<EOT
echo "\\n\\nPlease enter a whole number ... ";
\$output = "\\n\\nFactorial " . \$num . " = " . nfact(\$num) . "\\n\\n";
EOT;
		break;
	}
	case 'ruby': {
		$syntax_content = <<<EOT
EOT;
		break;
	}
	case 'perl': {
		$syntax_content = <<<EOT
    print \$primes[\$p], ", ";
print "\\n";
EOT;
		break;
	}
	case 'java': {
		$syntax_content = <<<EOT
        double d = Double.parseDouble("2.2250738585072012e-308");
        System.out.println("Value: " + d);
EOT;
		break;
	}
	case 'csharp': {
		$syntax_content = <<<EOT
   Console.WriteLine("Hello World");
EOT;
		break;
	}
	case 'c_cpp': {
		$syntax_content = <<<EOT
EOT;
		break;
	}
	case 'clojure': {
		$syntax_content = <<<EOT
  "returns a String parting in a given language"
  ([] (parting "World"))
  ([name] (parting name "en"))
    ; parameter "language" is set to "en", "es" or something else.
      "en" (str "Goodbye, " name)
      "es" (str "Adios, " name)
        (str "unsupported language " language))))))
(println (parting "Mark")) ; -> Goodbye, Mark
(println (parting "Mark" "es")) ; -> Adios, Mark
(println (parting "Mark", "xy")) ; -> java.lang.IllegalArgumentException: unsupported language xy               
EOT;
		break;
	}
	case 'ocaml': {
		$syntax_content = <<<EOT
EOT;
		break;
	}
	case 'textile': {
		$syntax_content = <<<EOT
EOT;
		break;
	}
	case 'groovy': {
		$syntax_content = <<<EOT
        out "thread loop \$i"
    out "main loop \$j"
assert counter.get() == 12            
EOT;
		break;
	}
	case 'scala': {
		$syntax_content = <<<EOT
  println("x = "+ x.sort((x: Int, y: Int) => x < y))
EOT;
		break;
	}
	case 'coldfusion': {
		$syntax_content = <<<EOT
<cfset welcome="Hello World!">
EOT;
		break;
	}
	case 'lua': {
		$syntax_content = <<<EOT
local gm = debug.getmetatable("")
    if type(other) ~= "table" then other = {other} end
]===]%{"blah", num_args(int)})
EOT;
		break;
	}
	case 'haxe': {
		$syntax_content = <<<EOT
        var greeting:String = "Hello World";
        var targets:Array<String> = ["Flash","Javascript","PHP","Neko","C++","iOS","Android","webOS"];
        trace("Haxe is a great language that can target:");
            trace (" - " + target);
        trace("And many more!");
EOT;
		break;
	}
	case 'markdown': {
		$syntax_content = <<<EOT
EOT;
		break;
	}
	case 'sql': {
		$syntax_content = <<<EOT
ORDER BY 2 DESC
EOT;
		break;
	}
	case 'pgsql': {
		$syntax_content = <<<EOT
    "date"      date
EOT;
		break;
	}
    case 'diff': {
        $syntax_content = <<<EOT
+var SearchHighlight = require("./search_highlight").SearchHighlight;
 
 /**
  * class EditSession
@@ -307,6 +308,13 @@ var EditSession = function(text, mode) {
         return token;
     };
 
+    this.highlight = function(re) {
+        if (!this.\$searchHighlight) {
+            var highlight = new SearchHighlight(null, "ace_selected_word", "text");
+            this.\$searchHighlight = this.addDynamicMarker(highlight);
+        }
+        this.\$searchHighlight.setRegexp(re);
+    }
     /**
     * EditSession.setUndoManager(undoManager)
     * - undoManager (UndoManager): The new undo manager
@@ -556,7 +564,8 @@ var EditSession = function(text, mode) {
             type : type || "line",
             renderer: typeof type == "function" ? type : null,
             clazz : clazz,
-            inFront: !!inFront
+            inFront: !!inFront,
+            id: id
         }
 
         if (inFront) {
diff --git a/lib/ace/editor.js b/lib/ace/editor.js
index 834e603..b27ec73 100644
--- a/lib/ace/editor.js
+++ b/lib/ace/editor.js
@@ -494,7 +494,7 @@ var Editor = function(renderer, session) {
      * Emitted when a selection has changed.
      **/
     this.onSelectionChange = function(e) {
-        var session = this.getSession();
+        var session = this.session;
 
         if (session.\$selectionMarker) {
             session.removeMarker(session.\$selectionMarker);
@@ -509,12 +509,40 @@ var Editor = function(renderer, session) {
             this.\$updateHighlightActiveLine();
         }
 
-        var self = this;
-        if (this.\$highlightSelectedWord && !this.\$wordHighlightTimer)
-            this.\$wordHighlightTimer = setTimeout(function() {
-                self.session.\$mode.highlightSelection(self);
-                self.\$wordHighlightTimer = null;
-            }, 30, this);
+        var re = this.\$highlightSelectedWord && this.\$getSelectionHighLightRegexp()
     };
diff --git a/lib/ace/search_highlight.js b/lib/ace/search_highlight.js
new file mode 100644
index 0000000..b2df779
--- /dev/null
+++ b/lib/ace/search_highlight.js
@@ -0,0 +1,3 @@
+new
+empty file        
EOT;
        break;
    }
    case 'golang': {
        $syntax_content = <<<EOT
// Concurrent computation of pi.
// See http://goo.gl/ZuTZM.
//
// This demonstrates Go's ability to handle
// large numbers of concurrent processes.
// It is an unreasonable way to calculate pi.
package main

import (
    "fmt"
    "math"
)

func main() {
    fmt.Println(pi(5000))
}

// pi launches n goroutines to compute an
// approximation of pi.
func pi(n int) float64 {
    ch := make(chan float64)
    for k := 0; k <= n; k++ {
        go term(ch, float64(k))
    }
    f := 0.0
    for k := 0; k <= n; k++ {
        f += <-ch
    }
    return f
}

func term(ch chan float64, k float64) {
    ch <- 4 * math.Pow(-1, k) / (2*k + 1)
}        
EOT;
        break;
    }
    case 'yaml': {
        $syntax_content = <<<EOT
# This sample document was taken from wikipedia:
# http://en.wikipedia.org/wiki/YAML#Sample_document
---
receipt:     Oz-Ware Purchase Invoice
date:        2007-08-06
customer:
    given:   Dorothy
    family:  Gale

items:
    - part_no:   'A4786'
      descrip:   Water Bucket (Filled)
      price:     1.47
      quantity:  4

    - part_no:   'E1628'
      descrip:   High Heeled "Ruby" Slippers
      size:      8
      price:     100.27
      quantity:  1

bill-to:  &id001
    street: |
            123 Tornado Alley
            Suite 16
    city:   East Centerville
    state:  KS

ship-to:  *id001

specialDelivery:  >
    Follow the Yellow Brick
    Road to the Emerald City.
    Pay no attention to the
    man behind the curtain.       
EOT;
        break;
    }
    case 'less': {
        $syntax_content = <<<EOT
    case 'xquery': {
        $syntax_content = <<<EOT
xquery version "1.0";

let \$message := "Hello World!"
return <results>
  <message>{\$message}</message>
</results>      
EOT;
        break;
    } 
    case 'scad': {
        $syntax_content = <<<EOT
// ace can highlight scad!
module Element(xpos, ypos, zpos){
    translate([xpos,ypos,zpos]){
        union(){
            cube([10,10,4],true);
            cylinder(10,15,5);
            translate([0,0,10])sphere(5);
        }
    }
}

union(){
    for(i=[0:30]){
        # Element(0,0,0);
        Element(15*i,0,0);
    }
}

for (i = [3, 5, 7, 11]){
    rotate([i*10,0,0])scale([1,1,i])cube(10);      
EOT;
        break;
    } 
    case 'sh': {
        $syntax_content = <<<EOT
#!/bin/sh

# Script to open a browser to current branch
# Repo formats:
# ssh   git@github.com:richoH/gh_pr.git
# http  https://richoH@github.com/richoH/gh_pr.git
# git   git://github.com/richoH/gh_pr.git

username=`git config --get github.user`

get_repo() {
    git remote -v | grep \${@:-\$username} | while read remote; do
      if repo=`echo \$remote | grep -E -o "git@github.com:[^ ]*"`; then
          echo \$repo | sed -e "s/^git@github\.com://" -e "s/\.git$//"
          exit 1
      fi
      if repo=`echo \$remote | grep -E -o "https?://([^@]*@)?github.com/[^ ]*\.git"`; then
          echo \$repo | sed -e "s|^https?://||" -e "s/^.*github\.com\///" -e "s/\.git$//"
          exit 1
      fi
      if repo=`echo \$remote | grep -E -o "git://github.com/[^ ]*\.git"`; then
          echo \$repo | sed -e "s|^git://github.com/||" -e "s/\.git$//"
          exit 1
      fi
    done

    if [ $? -eq 0 ]; then
        echo "Couldn't find a valid remote" >&2
        exit 1
    fi
}

if repo=`get_repo $@`; then
    branch=`git symbolic-ref HEAD 2>/dev/null`
    echo "http://github.com/\$repo/pull/new/\${branch##refs/heads/}"
else
    exit 1
fi      
EOT;
        break;
    } 
    case 'xquery': {
        $syntax_content = <<<EOT
xquery version "1.0";

let \$message := "Hello World!"
return <results>
  <message>{\$message}</message>
</results>      
EOT;
        break;
   }
    case 'latex': {
        $syntax_content = <<<EOT
\usepackage{amsmath}
\title{\LaTeX}
\date{}
\begin{document}
  \maketitle
  \LaTeX{} is a document preparation system for the \TeX{}
  typesetting program. It offers programmable desktop publishing
  features and extensive facilities for automating most aspects of
  typesetting and desktop publishing, including numbering and
  cross-referencing, tables and figures, page layout, bibliographies,
  and much more. \LaTeX{} was originally written in 1984 by Leslie
  Lamport and has become the dominant method for using \TeX; few
  people write in plain \TeX{} anymore. The current version  is
  \LaTeXe.
 
  % This is a comment; it will not be shown in the final output.
  % The following shows a little of the typesetting power of LaTeX:
  \begin{align}
    E &= mc^2                              \\
    m &= \frac{m_0}{\sqrt{1-\frac{v^2}{c^2}}}
  \end{align}
\end{document}   
EOT;
        break;
   } 
    case 'liquid': {
        $syntax_content = <<<EOT
The following examples can be found in full at http://liquidmarkup.org/

Liquid is an extraction from the e-commerce system Shopify.
Shopify powers many thousands of e-commerce stores which all call for unique designs.
For this we developed Liquid which allows our customers complete design freedom while
maintaining the integrity of our servers.

Liquid has been in production use since June 2006 and is now used by many other
hosted web applications.

It was developed for usage in Ruby on Rails web applications and integrates seamlessly
as a plugin but it also works excellently as a stand alone library.

Here's what it looks like:

  <ul id="products">
    {% for product in products %}
      <li>
        <h2>{{ product.title }}</h2>
        Only {{ product.price | format_as_money }}

        <p>{{ product.description | prettyprint | truncate: 200  }}</p>

      </li>
    {% endfor %}
  </ul>


Some more features include:

<h2>Filters</h2>
<p> The word "tobi" in uppercase: {{ 'tobi' | upcase }} </p>
<p>The word "tobi" has {{ 'tobi' | size }} letters! </p>
<p>Change "Hello world" to "Hi world": {{ 'Hello world' | replace: 'Hello', 'Hi' }} </p>
<p>The date today is {{ 'now' | date: "%Y %b %d" }} </p>


<h2>If</h2>
<p>
  {% if user.name == 'tobi' or user.name == 'marc' %} 
    hi marc or tobi
  {% endif %}
</p>


<h2>Case</h2>
<p>
  {% case template %}
    {% when 'index' %}
       Welcome
    {% when 'product' %}
       {{ product.vendor | link_to_vendor }} / {{ product.title }}
    {% else %}
       {{ page_title }}
  {% endcase %}
</p>


<h2>For Loops</h2>
<p>
  {% for item in array %} 
    {{ item }}
  {% endfor %}
</p>


<h2>Tables</h2>
<p>
  {% tablerow item in items cols: 3 %}
    {% if tablerowloop.col_first %}
      First column: {{ item.variable }}
    {% else %}
      Different column: {{ item.variable }}
    {% endif %}
  {% endtablerow %}
</p> 
EOT;
        break;
   }
    case 'powershell': {
        $syntax_content = <<<EOT
# This is a simple comment
function Hello(\$name) {
  Write-host "Hello \$name"
}

function add(\$left, \$right=4) {
    if (\$right -ne 4) {
        return \$left
    } elseif (\$left -eq \$null -and \$right -eq 2) {
        return 3
    } else {
        return 2
    }
}

\$number = 1 + 2;
\$number += 3

Write-Host Hello -name "World"

\$an_array = @(1, 2, 3)
\$a_hash = @{"something" = "something else"}

& notepad .\readme.md  
EOT;
        break;
   } 
    case 'jsx': {
        $syntax_content = <<<EOT
class _Main {
    static function main(args : string[]) :void {
        log "Hello, world!";
    }
} 
EOT;
        break;
   }
}

/* create test textarea */
$smarty->assign('testarea', $this->CreateTextArea(false, $id, $syntax_content, 'testarea', '', '', '', '', '', '', 'AceEditor', cms_userprefs::get_for_user($userid, 'mode', 'theme', 'fontsize', 'full_line', 'highlight_active', 'show_invisibles', 'persisten_hscroll', 'keybinding', 'soft_wrap', 'show_gutter', 'print_margin', 'soft_tab', 'highlight_selected', 'enable_behaviors')));

/* ProcessTempalte */
echo $this->ProcessTemplate('settings.tpl');
<?php

class Footer{

  public function display(){
    $peacock = new Peacock;
    $string = '<footer>
      <div class="row">
        <div class="col-md-6">
          <span>PeacockCMS </span><span>'.$peacock->peacockVersion().'</span>
          <br>PeacockCMS is under the GNU General Public License V3<br>
          <a href="http://docs.peacockcms.com" target="_blank">View Documentation</a><br>
          <br>
          <span>Problem/Bug please email</span><br>bugs@peacockcms.com<br><br>
          <span>Feature Request please email</span><br>feedback@peacockcms.com
        </div>
        <div class="col-md-6">

        </div>
      </div>
    </footer>';
    return $string;
  }

}

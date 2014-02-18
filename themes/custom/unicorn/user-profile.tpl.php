<section id="wrapper">
<!-- static top nav found throughout the site -->
  <!-- <header class="site_nav common_title row">
    <div class="unicorn_logo col-md-2">
      <img src="http://placekitten.com/80/80" alt="">
    </div>
    <div class="site_title col-md-4">
      <h1>Unicorn Factory</h1>
    </div>
    <div class="teams_button col-md-2">Teams</div>
    <div class="projects_button col-md-2">Projects</div>
    <div class="logout_button col-md-2">Logout</div>
  </header> -->

<!-- personal info div containing avatar, name and current team status -->
  <section ng-controller="UserProfileCtrl" ng-init="uid = <?php print $elements["#account"]->uid ?>">
    <div class="row">
      <div class="personal_avatar col-lg-4">
        <div ng-bind-html="page.Avatar" class"img-thumbnail" alt=""></div>
      </div>
      <div class="name_status col-lg-4">
        <h2>{{page.users_name}}</h2>
        <p>{{page.users_mail}}</p>
        <!-- The following ng-show/ng-hide depend on value of Slogan.
          -- if Slogan is defined it will display, otherwise a link to add a slogan. -->
        <div ng-show="page.Slogan"><p>{{page.Slogan}}</p></div>
        <div ng-hide="page.Slogan">
          <a href="#">Add a Slogan</a>
        </div>
        <button type="button" class="btn btn-default col-lg-8"><a href="/node/{{page.TeamID[0]}}">{{page.TeamName[0]}}</a></button>
        <button type="button" class="btn btn-default col-lg-8"><a href="/node/{{page.ProjectID[0]}}">{{page.ProjectName[0]}}</a></button>
      </div>

      <div class="personal_social col-lg-4">
        <ul class="social_network row">
           <li class="col-lg-3"><a href="https://www.facebook.com/{{page.Facebook}}" class="btn btn-default btn-lg btn-primary active" role="button">FB</a></li>
           <li class="col-lg-3"><a href="https://twitter.com/{{page.Twitter}}" class="btn btn-default btn-lg" role="button">TW</a></li>
           <li class="col-lg-3"><a href="http://github.com/{{page.Github}}" class="btn btn-default btn-lg" role="button">GH</a></li>
           <li class="col-lg-3"><a href="{{page.Linkedin}}" class="btn btn-default btn-lg" role="button">LI</a></li>
        </ul>
      </div>
    </div>
  </section>
  <hr>

<!-- dynamic skills section with accordion fold -->
  <section id="skills" class="container-fluid">

  <!-- static header -->
  <div class="row common_title">
    <div id="skills_header" class="row">
      <h2 class="col-lg-8">Skills</h2>
      <ul class="col-lg-4">
        <li class="small">My best skill is ... </li>
        <li class="small">My most desiteable skill is ... </li>
      </ul>
    </div>
    </div>

    <hr>
<!-- accordion content -->


    <div class="progress">
      <div class="progress-bar progress-bar-success" style="width: 10%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 20%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
    </div>

    <div class="progress">
      <div class="progress-bar progress-bar-success" style="width: 35%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 60%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
    </div>

    <div class="progress">
      <div class="progress-bar progress-bar-success" style="width: 40%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 20%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
    </div>
    
    <div class="progress">
      <div class="progress-bar progress-bar-success" style="width: 10%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 60%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
    </div>
    <div class="progress">
      <div class="progress-bar progress-bar-success" style="width: 35%">
        <span class="sr-only">35% Complete (success)</span>
      </div>
      <div class="progress-bar progress-bar-warning" style="width: 20%">
        <span class="sr-only">20% Complete (warning)</span>
      </div>
    </div>
  </section>

  <hr>
<!-- static project section with dynamic project inputs -->
  <section id="projects" class="container-fluid row">
    <div class="project_header common_title">
      <h2>Projects</h2>
    </div>

    <hr>

    <div class="project_content">
      <div class="project1 col-lg-4">
        <h3>Project 1</h3>
      </div>
      <div class="project2 col-lg-4">
        <h3>Project 2</h3>
      </div>
      <div class="project3 col-lg-4">
        <h3>Project 3</h3>
      </div>
    </div>
  </section>

<hr>

<!-- wishlist -->
<div class="row" class="container-fluid">
  <section class="wishlist col-lg-6">
    <div class="wishlist_title common_title">
      <h2>Wishlist</h2>
    </div>

    <hr>

    <ul class="border">
      <li><input type="checkbox" name="color" value="">
Wish 1<br></li>
      <li><input type="checkbox" name="color" value="">
Wish 2<br></li>
      <li><input type="checkbox" name="color" value="">
Wish 3<br></li>
      <li><input type="checkbox" name="color" value="">
Wish 4<br></li>
      <li><input type="checkbox" name="color" value="">
Wish 5<br></li>
      <li><input type="checkbox" name="color" value="">
Wish 5<br></li>
      <li><input type="checkbox" name="color" value="">
Wish 6<br></li>
      <li><input type="checkbox" name="color" value="">
Wish 7<br></li>
      <li><input type="checkbox" name="color" value="">
Wish 8<br></li>
      <li><input type="checkbox" name="color" value="">
Wish 9<br></li>
    </ul>
  </section>
<!-- live activity feed -->
  <section class="activity_feed col-lg-6">
    <div class="activity_title common_title">
      <h2>Activity Feed</h2>
    </div>

<hr>

    <div class="live_feed">
      
    </div>
  </section>

<hr>

</div>
  <div class="scroll_button">
   <a href="#navbar"><button type="button" class="btn btn-primary active">TOP</button></a>
  </div>
  
  <hr>

  <!-- sitewide common footer -->
  <footer class="common_title row">
    <div class="col-lg-12">
    <h3>My Planet Digital</h3>
    <address>
      <h3>Company Address</h3>
      <a href="mailto:you@youraddress.com">Email My Planet Digital</a>
    </address>
    <div class="phone">555-555-5555</div>
    </div>
  </footer>
  
<!-- end of wrapper for user profile -->
</section>


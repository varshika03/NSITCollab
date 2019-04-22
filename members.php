<?php include("header.php"); ?>
<div class="container feed">
	<div class="row">
		<div class="col s12 center-align">
			<h1>Members</h1>
		</div>
		<div class="col s12 m12 l3 sidebar">
			<h3>Filter</h3>
			<div class="row">
				<div class="col s6 m9 l12 margin-bottom">
					<form>
						<input type="text" name="search" placeholder="Search" onkeyup="showUser(this.value)">
						<label for="search">Search for User</label>
					</form>
				</div>
				<div class="col s6 m3 l12">
					<a class='dropdown-trigger btn' href='#' data-target='dropdown1'>Sort By</a>
					<!-- Dropdown Structure -->
					<ul id='dropdown1' class='dropdown-content'>
						<li id="filter-name"><a href="#!">Name</a></li>
						<li id="filter-recent"><a href="#!">User Type</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col s12 m12 l9 main">
			<div id="results-main">
				<h3>Search Results</h3>
				<div id="results">
				</div>
			</div>
			<div id="insert-main">
				<h3>All Members</h3>
				<div id="insert">
					<?php include("php/user-table.php"); ?>
				</div>
		</div>
			
		</div>
	</div>
</div>
<?php include("footer.php"); ?>
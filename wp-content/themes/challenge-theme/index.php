<?php get_header(); ?>

<div class="container container-center">

<ul class="nav nav-pills pull-right" id="top-menu">
  <li><a href="#">Now Playing</a></li>
  <li><a href="#">Rate Songs</a></li>
</ul>

	<div class="row">
		
		<div class="header-page text-center">
			<img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=H&w=100&h=100" alt="">
			<h1>Hangar O'Clock Songs</h1>			
		</div>

		<div class="col-md-offset-3 col-md-6">
			<form action="/" class="search-form">				
				<div class="input-group input-group-lg">
			      <input type="text" name="q" class="form-control" placeholder="Search Music" autocomplete="off">
			      <span class="input-group-btn">
			        <button class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
			      </span>
			    </div><!-- /input-group -->
			</form>

			<div id="no-results" class="alert alert-info text-center collapse">
				<h3>No Songs Found!</h3>
			</div>

			<table class="table" id="player-container">				

				<thead>

					<tr id="loader"><td colspan="3" align="center"><i class="fa fa-circle-o-notch fa-spin fa-5x fa-fw fa-inverse"></i></td></tr>

				</thead>

				<tbody></tbody>

			</table>

		</div>

	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="video-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body iframe-container">
      </div>
<!--       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<script id="song-item-tmpl" type="text/x-jQuery-tmpl">     

    <tr class="song">
        <td>
            <a href="#" data-toggle="modal" data-target="#video-modal" data-video="${url}" data-title="${title.rendered}" class="play-song-btn"><i class="fa fa-caret-square-o-right fa-4" aria-hidden="true"></i></a>
        </td>
        <td>
            <h4 class="media-heading">${title.rendered}</h4>
            {{if typeof artist != 'undefined' &&  artist.length > 0 }}
                {{each(i, artist_data) artist}}
                    ${artist_data.name}
                {{/each}}
                <br>
            {{/if}} 
        </td>
        <td>
            <div class="btn-group pull-right" role="group" aria-label="...">
              <button type="button" class="btn btn-default">Today</button>
              <button type="button" class="btn btn-default" >Friday</button>
            </div>
        </td>
    </tr>           

</script>

<?php get_footer(); ?>
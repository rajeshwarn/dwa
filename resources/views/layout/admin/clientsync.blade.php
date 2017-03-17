@extends('indexadmin')

	@section('contentadmin')

		<section id="dashboard-admin-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2 left-dashboard">

						<div class="admin-identity-wrap">
							<img src="{{ URL::to('resources/assets/img/default_profile.png') }}" class="admin-thumb" width="40px" height="40px">
							<h3 class="greet-welcome">Welcome back, <br> {{ session('user') }}</h3>
						</div>
					
						<nav id="admin-main-menu">
							<ul>
								<li><a href="new-movie"><i class="fa fa-user" aria-hidden="true"></i> Movies</a></li>

								@if( session('role') == 'super-administrator' )
								<li><a href="user"><i class="fa fa-user" aria-hidden="true"></i> Users</a></li>
								<li class="selected">
									<a href="client-sync"><i class="fa fa-users" aria-hidden="true"></i> Client Sync</a>
									<ul>
										<li  class="selected"><a href="client-sync">Client Sync</a></li>
										<li><a href="new-client">Add Client</a></li>
									</ul>
								</li>
								<li><a href="social-profiles"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
								@endif
							</ul>
						</nav>
					</div>

					<div class="col-md-10 right-dashboard">

						<h2 class="title">ALL CLIENT</h2>
						@if(session() -> has('msg'))
							{!! session('msg') !!}
						@endif

						{!! $msg or '' !!}
						
						@if( app('request') -> input('filter') )
							<?php $filter = $_GET['filter']; ?>
						@else
							<?php $filter = ''; ?>
						@endif

						@if( app('request') -> input('sort') )
							<?php $sort = $_GET['sort']; ?>
						@else
							<?php $sort = ''; ?>
						@endif	

						<div class="table-user-wrap">
							<div class="table-responsive">
								<form action="bulk-user" method="POST">

									<div class="bulk-wrap">
										<select name="bulk-action">
											<option value="">Bulk Action</option>
											<option value="Delete Checked Item">Delete Checked Item</option>
										</select>

										<input type="hidden" name="_token" value="{{ csrf_token() }}">

										<button type="submit" class="btn btn-default btn-submit">Apply</button>
									</div>

									<table class="table table-user">
										<tr>
											<th><input type="checkbox" name="checkallmovie"></th>
											<th class="user-username-head">
												<?php 
													if( $filter == 'client' AND $sort == 'asc' )
														{ ?>
															<a href="client-sync?filter=client&sort=desc">Client <i class="fa fa-sort-asc" aria-hidden="true"></i></a>
														<?php }
													else if( $filter == 'title' AND $sort == 'desc' )
														{ ?>
															<a href="client-sync?filter=client&sort=asc">Client <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
														<?php }
													else
														{ ?>
															<a href="client-sync?filter=client&sort=asc">Client <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
											<th class="user-username-head">
												<?php 
													if( $filter == 'time_sync' AND $sort == 'asc' )
														{ ?>
															<a href="client-sync?filter=time_sync&sort=desc">Time Sync <i class="fa fa-sort-asc" aria-hidden="true"></i></a>
														<?php }
													else if( $filter == 'title' AND $sort == 'desc' )
														{ ?>
															<a href="client-sync?filter=time_sync&sort=asc">Time Sync <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
														<?php }
													else
														{ ?>
															<a href="client-sync?filter=time_sync&sort=asc">Time Sync <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
											<th class="user-username-head">
												<?php 
													if( $filter == 'category' AND $sort == 'asc' )
														{ ?>
															<a href="client-sync?filter=category&sort=desc">Category <i class="fa fa-sort-asc" aria-hidden="true"></i></a>
														<?php }
													else if( $filter == 'title' AND $sort == 'desc' )
														{ ?>
															<a href="client-sync?filter=category&sort=asc">Category <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
														<?php }
													else
														{ ?>
															<a href="client-sync?filter=category&sort=asc">Category <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
										</tr>

										@foreach ( $client as $item )
											<tr class="item">
												<td><input type="checkbox" name="checkuser[]" value="{{$item->id}}" class="checkuser"></td>
												<td class="user-username">
													<a class="btn-title-link" href="edit-user/{{ $item->id }}">{{ $item->client }}</a>
													<div class="action-btn-wrap">
														<a class="btn-edit" href="edit-user/{{ $item->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
														<button type="button" class="btn-trash" data-toggle="modal" data-id="{{ $item->id }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
													</div>
												</td>
												<td class="user-name">{{ $item->time_sync }}</td>
												<td class="user-email">{{ $item->categori }}</td>
											</tr>							
										@endforeach
									</table>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	@stop
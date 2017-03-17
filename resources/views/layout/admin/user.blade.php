@extends('indexadmin')

	@section('contentadmin')

		<section id="dashboard-admin-section">
			<div class="container-fluid">
				<div class="row admin-row">
					<div class="col-md-2 left-dashboard">

						<div class="admin-identity-wrap">
							<img src="{{ URL::to('resources/assets/img/default_profile.png') }}" class="admin-thumb" width="40px" height="40px">
							<h3 class="greet-welcome">Welcome back, <br> {{ session('user') }}</h3>
						</div>

						<nav id="admin-main-menu">
							<ul>
								<li><a href="movie"><i class="fa fa-film" aria-hidden="true"></i></i> Movies</a></li>

								@if( session('role') == 'super-administrator' )
								<li class="selected"><a href="user"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
									<ul>
										<li class="selected"><a href="user">User</a></li>
										<li><a href="new-user">Add User</a></li>
									</ul>
								</li>
								<li>
									<a href="client-sync"><i class="fa fa-users" aria-hidden="true"></i> Client Sync</a>
								</li>
								<li><a href="social-profiles"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
								@endif
							</ul>
						</nav>
					</div>

					<div class="col-md-10 right-dashboard">

						<h2 class="title">ALL USER</h2>

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
													if( $filter == 'username' AND $sort == 'asc' )
														{ ?>
															<a href="user?filter=username&sort=desc">Username <i class="fa fa-sort-asc" aria-hidden="true"></i></a>
														<?php }
													else if( $filter == 'title' AND $sort == 'desc' )
														{ ?>
															<a href="user?filter=username&sort=asc">Username <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
														<?php }
													else
														{ ?>
															<a href="user?filter=username&sort=asc">Username <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
											<th class="user-name-head">
												<?php
													if( $filter == 'name' AND $sort == 'asc' )
														{ ?>
															<a href="user?filter=name&sort=desc">Name <i class="fa fa-sort-asc" aria-hidden="true"></i></a>
														<?php }
													else if( $filter == 'name' AND $sort == 'desc' )
														{ ?>
															<a href="user?filter=name&sort=asc">Name <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
														<?php }
													else
														{ ?>
															<a href="user?filter=name&sort=asc">Name <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
											<th class="user-email-head">
												<?php
													if( $filter == 'email' AND $sort == 'asc' )
														{ ?>
															<a href="user?filter=email&sort=desc">Email <i class="fa fa-sort-asc" aria-hidden="true"></i></a>
														<?php }
													else if ( $filter == 'email' AND $sort == 'desc' )
														{ ?>
															<a href="user?filter=email&sort=asc">Email <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
														<?php }
													else
														{ ?>
															<a href="user?filter=email&sort=asc">Email <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
											<th class="user-role-head">
												<?php
													if( $filter == 'role' AND $sort == 'asc' )
														{ ?>
															<a href="user?filter=role&sort=desc">Role <i class="fa fa-sort-asc" aria-hidden="true"></i></a>
														<?php }
													else if( $filter == 'role' AND $sort == 'desc' )
														{ ?>
															<a href="user?filter=role&sort=asc">Role <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
														<?php }
													else
														{ ?>
															<a href="user?filter=role&sort=asc">Role <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
											<th class="user-last-modify-head">
												<?php 
													if( $filter == 'updated_at' && $sort == 'asc' )
														{ ?>
															<a href="user?filter=updated_at&sort=desc">Last Modified <i class="fa fa-sort-asc" aria-hidden="true"></i></a>		
														<?php }
													else if( $filter == 'updated_at' && $sort == 'desc' )
														{ ?>
															<a href="user?filter=updated_at&sort=asc">Last Modified <i class="fa fa-sort-desc" aria-hidden="true"></i></a>		
														<?php }
													else
														{ ?>
															<a href="user?filter=updated_at&sort=asc">Last Modified <i class="fa fa-sort" aria-hidden="true"></i></a>
														<?php }
												?>
											</th>
										</tr>

									@foreach ( $user as $item )
										<?php 
											$last_modify = explode(' ', $item->updated_at);
										?>
										<tr class="item">
											<td><input type="checkbox" name="checkuser[]" value="{{$item->id}}" class="checkuser"></td>
											<td class="user-username">
												<a class="btn-title-link" href="edit-user/{{ $item->id }}">{{ $item->username }}</a>
												<div class="action-btn-wrap">
													<a class="btn-edit" href="edit-user/{{ $item->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
													<button type="button" class="btn-trash" data-toggle="modal" data-id="{{ $item->id }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
												</div>
											</td>
											<td class="user-name">{{ $item->name }}</td>
											<td class="user-email">{{ $item->email }}</td>
											<td class="user-role">{{ $item->role }}</td>
											<td class="user-last-modify">{{ $last_modify[0] }}</td>
										</tr>							
									@endforeach

									</table>
								</form>
							</div>
						</div>	

						<div id="user-paging-wrap">
							{{ $user -> links() }}		
						</div>

					</div>
				</div>
			</div>
		</section>

		<div id="modal-confirm-delete-user" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title">Delete User</h4>
		      </div>
		      <div class="modal-body">
		        <p>Are you sure you want to remove this item ?</p>
		        <div class="btn-action-wrap">
			        <a name="link-trash" href="">Yes</a>
			        <button type="button" class="btn btn-default btn-close" data-dismiss="modal">No</button>
		        </div>
		      </div>
		    </div>

		  </div>
		</div>
	@stop


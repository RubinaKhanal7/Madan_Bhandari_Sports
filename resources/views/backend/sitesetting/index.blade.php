@extends('backend.layouts.master')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ url('admin') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                    Back</button></a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Slogan</th>
                <th>Email</th>
                <th>Established Year</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sitesettings as $sitesetting)
                <tr data-widget="expandable-table" aria-expanded="false">
                    <td width="5%">{{ $loop->iteration }}</td>
                    <td>{{ $sitesetting->title_en }}</td>
                    <td>{{ $sitesetting->slogan_en }}</td>
                    <td>
                        @php
                            $officeEmails = json_decode($sitesetting->email, true);
                        @endphp
                        @if (is_array($officeEmails))
                            @foreach ($officeEmails as $email)
                                {{ $email }} <br>
                            @endforeach
                        @else
                            {{ $sitesetting->email }}
                        @endif
                    </td>
                    <td>{{ $sitesetting->established_year }}</td>
                    
                    <td>
                        @if($sitesetting->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td style="white-space: nowrap;">
                        <a href="{{ route('admin.site-settings.edit', $sitesetting->id) }}" 
                           class="btn btn-outline-primary btn-sm" style="width: 32px;">
                            <i class="fas fa-edit"></i>
                        </a>
                        
                        <button type="button" class="btn btn-outline-info btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#socialMediaModal{{ $sitesetting->id }}"
                                style="width: 32px;">
                            S
                        </button>
                    </td>
                </tr>

                <!-- Social Media Modal -->
                <div class="modal fade" id="socialMediaModal{{ $sitesetting->id }}" tabindex="-1" 
                    aria-labelledby="socialMediaModalLabel{{ $sitesetting->id }}" aria-hidden="true">
                   <div class="modal-dialog modal-lg">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="socialMediaModalLabel{{ $sitesetting->id }}">Edit Social Media Links</h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                               <form action="{{ route('admin.socialmedia.update', $sitesetting->socialmedia) }}" method="POST">
                                   @csrf
                                   @method('PUT')
               
                                   <div class="row mb-3">
                                       <div class="col-md-6">
                                           <label for="facebook_link">Facebook Link</label>
                                           <input type="url" name="facebook_link" id="facebook_link" class="form-control" 
                                                  value="{{ old('facebook_link', $sitesetting->socialMedia->facebook_link ?? '') }}">
                                       </div>
                                       <div class="col-md-6">
                                           <label for="instagram_link">Instagram Link</label>
                                           <input type="url" name="instagram_link" id="instagram_link" class="form-control" 
                                                  value="{{ old('instagram_link', $sitesetting->socialMedia->instagram_link ?? '') }}">
                                       </div>
                                   </div>
               
                                   <div class="row mb-3">
                                       <div class="col-md-6">
                                           <label for="snapchat_link">Snapchat Link</label>
                                           <input type="url" name="snapchat_link" id="snapchat_link" class="form-control" 
                                                  value="{{ old('snapchat_link', $sitesetting->socialMedia->snapchat_link ?? '') }}">
                                       </div>
                                       <div class="col-md-6">
                                           <label for="linkedin_link">LinkedIn Link</label>
                                           <input type="url" name="linkedin_link" id="linkedin_link" class="form-control" 
                                                  value="{{ old('linkedin_link', $sitesetting->socialMedia->linkedin_link ?? '') }}">
                                       </div>
                                   </div>
               
                                   <div class="row mb-3">
                                       <div class="col-md-6">
                                           <label for="tiktok_link">TikTok Link</label>
                                           <input type="url" name="tiktok_link" id="tiktok_link" class="form-control" 
                                                  value="{{ old('tiktok_link', $sitesetting->socialMedia->tiktok_link ?? '') }}">
                                       </div>
                                       <div class="col-md-6">
                                           <label for="youtube_link">YouTube Link</label>
                                           <input type="url" name="youtube_link" id="youtube_link" class="form-control" 
                                                  value="{{ old('youtube_link', $sitesetting->socialMedia->youtube_link ?? '') }}">
                                       </div>
                                   </div>
               
                                   <div class="row mb-3">
                                       <div class="col-md-6">
                                           <label for="twitter_link">Twitter Link</label>
                                           <input type="url" name="twitter_link" id="twitter_link" class="form-control" 
                                                  value="{{ old('twitter_link', $sitesetting->socialMedia->twitter_link ?? '') }}">
                                       </div>
                                       <div class="col-md-6">
                                           <label for="embed_fbpage">Facebook Page Embed Code</label>
                                           <textarea name="embed_fbpage" id="embed_fbpage" class="form-control" rows="3">{{ old('embed_fbpage', $sitesetting->socialMedia->embed_fbpage ?? '') }}</textarea>
                                       </div>
                                   </div>
               
                                   <div class="form-group">
                                       <button type="submit" class="btn btn-primary">Save Changes</button>
                                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                   </div>
                               </form>
                           </div>
                       </div>
                   </div>
               </div>
               
            @empty
                <tr>
                    <td colspan="8">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
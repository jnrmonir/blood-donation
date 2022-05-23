<div>
    <div class="card direct-chat direct-chat-primary rounded-0">
        <div class="card-header">

            @if($user_name)
            <h3 class="card-title">{{ $user_name }}</h3>
            @else
            <h3 class="card-title">Direct Chat</h3>
            @endif

          <div class="card-tools">
            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary">3</span>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
              <i class="fas fa-comments"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <!-- Conversations are loaded here -->
          <div class="direct-chat-messages" id="chat" wire:poll.keep-alive="getMessage">
            <!-- Message. Default to the left -->
            @if($messages != [])
              @foreach ($messages as $message)
              @if($message->from_id == Auth::id() && $message->to_id == $to_id)
              <div class="direct-chat-msg right">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-timestamp float-left">{{ $message->updated_at->diffForHumans() }}</span>
                    <span class="direct-chat-name float-right ">{{ $message->fromUser->name }}</span>
                </div>
                <!-- /.direct-chat-infos -->
                @if ($message->fromUser->profile_photo_path != null)
                <img class="direct-chat-img" src="{{ Storage::url('images/avatars/'.$message->fromUser->profile_photo_path) }}" alt="{{ $message->fromUser->name }}">
                @else
                <img class="direct-chat-img" src="{{ asset('images/avator.png') }}" alt="{{ $message->fromUser->name }}">
                @endif
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  {{ $message->body }}
                </div>
                <!-- /.direct-chat-text -->
              </div>
              @endif

              @if($message->from_id == $to_id && $message->to_id == Auth::id())
              <div class="direct-chat-msg ">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-timestamp float-right">{{ $message->updated_at->diffForHumans() }}</span>
                    <span class="direct-chat-name float-left ">{{ $message->fromUser->name }}</span>
                </div>
                <!-- /.direct-chat-infos -->
                @if ($message->fromUser->profile_photo_path != null)
                <img class="direct-chat-img" src="{{ Storage::url('images/avatars/'.$message->fromUser->profile_photo_path) }}" alt="{{ $message->fromUser->name }}">
                @else
                <img class="direct-chat-img" src="{{ asset('images/avator.png') }}" alt="{{ $message->fromUser->name }}">
                @endif
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  {{ $message->body }}
                </div>
                <!-- /.direct-chat-text -->
              </div>
              @endif
              @endforeach
            @endif
            <!-- /.direct-chat-msg -->

            <!-- Message to the right -->

            <!-- /.direct-chat-msg -->


          </div>

          {{-- <div wire:loading> --}}
              {{-- <script>
                var objDiv1 = document.getElementById("chat");
                objDiv1.scrollTop = objDiv1.scrollHeight;
              </script> --}}
          {{-- </div> --}}
          <!--/.direct-chat-messages-->

          <!-- Contacts are loaded here -->
          {{-- <div class="direct-chat-contacts">
            <ul class="contacts-list">
              <li>
                <a href="#">
                  <img class="contacts-list-img" src="{{ asset('frontend/assets/img/user1-128x128.jpg') }}">

                  <div class="contacts-list-info">
                    <span class="contacts-list-name">
                      Count Dracula
                      <small class="contacts-list-date float-right">2/28/2015</small>
                    </span>
                    <span class="contacts-list-msg">How have you been? I was...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <!-- End Contact Item -->
              <li>
                <a href="#">
                  <img class="contacts-list-img" src="dist/img/user7-128x128.jpg">

                  <div class="contacts-list-info">
                    <span class="contacts-list-name">
                      Sarah Doe
                      <small class="contacts-list-date float-right">2/23/2015</small>
                    </span>
                    <span class="contacts-list-msg">I will be waiting for...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <!-- End Contact Item -->
              <li>
                <a href="#">
                  <img class="contacts-list-img" src="{{ asset('frontend/assets/img/user1-128x128.jpg') }}">

                  <div class="contacts-list-info">
                    <span class="contacts-list-name">
                      Nadia Jolie
                      <small class="contacts-list-date float-right">2/20/2015</small>
                    </span>
                    <span class="contacts-list-msg">I'll call you back at...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <!-- End Contact Item -->
              <li>
                <a href="#">
                  <img class="contacts-list-img" src="{{ asset('frontend/assets/img/user1-128x128.jpg') }}">

                  <div class="contacts-list-info">
                    <span class="contacts-list-name">
                      Nora S. Vans
                      <small class="contacts-list-date float-right">2/10/2015</small>
                    </span>
                    <span class="contacts-list-msg">Where is your new...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <!-- End Contact Item -->
              <li>
                <a href="#">
                  <img class="contacts-list-img" src="{{ asset('frontend/assets/img/user1-128x128.jpg') }}">

                  <div class="contacts-list-info">
                    <span class="contacts-list-name">
                      John K.
                      <small class="contacts-list-date float-right">1/27/2015</small>
                    </span>
                    <span class="contacts-list-msg">Can I take a look at...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <!-- End Contact Item -->
              <li>
                <a href="#">
                  <img class="contacts-list-img" src="{{ asset('frontend/assets/img/user1-128x128.jpg') }}">

                  <div class="contacts-list-info">
                    <span class="contacts-list-name">
                      Kenneth M.
                      <small class="contacts-list-date float-right">1/4/2015</small>
                    </span>
                    <span class="contacts-list-msg">Never mind I found...</span>
                  </div>
                  <!-- /.contacts-list-info -->
                </a>
              </li>
              <!-- End Contact Item -->
            </ul>
            <!-- /.contacts-list -->
          </div> --}}
          <!-- /.direct-chat-pane -->

        </div>
        <!-- /.card-body -->
        <div class="card-footer">

            @livewire('chat.donar-box', ['id' => $to_id], key($to_id))

        </div>
        <!-- /.card-footer-->
    </div>

    @if($messages != [])
    <script>
        var objDiv = document.getElementById("chat");
        objDiv.scrollTop = objDiv.scrollHeight;
    </script>
    @endif

    @if($status)
    <script>
        var objDiv = document.getElementById("chat");
        objDiv.scrollTop = objDiv.scrollHeight;
    </script>
    @endif
</div>

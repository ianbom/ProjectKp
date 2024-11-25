@inject('markdown', 'Parsedown')

@php
    // TODO: There should be a better place for this.
    $markdown->setSafeMode(true);
@endphp

<style>
    .media-body {
      background-color: white; /* Sets background to white */
      border-top-right-radius: 7px; /* Top right corner rounded */
      border-bottom-right-radius: 7px; /* Bottom right corner rounded */
      border-bottom-left-radius: 0px; /* Bottom left corner square */
      border-top-left-radius: 7px; /* Top left corner rounded */
      padding: 10px; /* Optional padding for spacing inside the box */
      position: relative; /* Added relative positioning */
      margin-bottom: 20px; /* Adds margin between media bodies */
    }

    .button-row {
      display: flex; /* Enables flexbox for buttons */
      gap: 8px; /* Adds 8px space between buttons */
      position: absolute; /* Positions buttons relative to media-body */
      right: 10px; /* Distance from the right edge */
      bottom: 10px; /* Distance from the bottom edge */
    }

    .btn-edit, .btn-delete {
      border-radius: 7px; /* Adds rounded corners */
      padding: 5px 10px; /* Adjusts button padding */
      font-size: 14px; /* Adjusts font size */
      color: white;

    }

    .btn-delete {
      background-color: #0B20E9; /* Orange color for Edit button */
      color: white;
      border: 2px solid #0B20E9; /* Explicitly set border width and color */
    }
.btn-delete:hover{
    border: none;
}
    .btn-edit {
    border: 2px solid #0B20E9; /* Explicitly set border width and color */
    background-color: #FFFFFF; /* White background color */
    color: #0B20E9; /* Text color matching the border */
}


    .modal-content {
    border-radius: 7px; /* Makes the modal corners rounded */
    overflow: hidden; /* Ensures content respects the border radius */
}

.modal-header {
    border-top-left-radius: 7px; /* Optional: Explicitly set header corners */
    border-top-right-radius: 7px;
}

.modal-footer {
    border-bottom-left-radius: 7px; /* Optional: Explicitly set footer corners */
    border-bottom-right-radius: 7px;
}


    textarea.form-control {
      background-color: #E8F0FE; /* Sets the background color */
      border-radius: 7px; /* Adds rounded corners */
      border: none; /* Optional: Adds a subtle border */
      padding: 10px; /* Ensures spacing inside the textarea */
      color: #333; /* Ensures text is readable */
      box-shadow: none; /* Removes any default shadow */
      box-sizing: border-box; /* Ensures padding doesn't affect layout */
    }

.modal-header .close {
    color: #ffffff; /* Sets the color of the Close button */
    font-size: 1.5rem; /* Adjusts the font size */
    border: none; /* Removes any border */
    background: none; /* Ensures no background */
    cursor: pointer; /* Shows a pointer cursor for better UX */
}

.modal-header .close:hover {
    color: #9ba4f3; /* Keeps the same color on hover */
    background: none; /* No hover background */
    border: none; /* Ensures no border on hover */
    cursor: pointer; /* Keeps pointer cursor */
}
.modal-header {
    background-color: #0B20E9;
    color : #ffffff;
}
.btn-secondary{
    border-radius: 7px;
}
  </style>

<div id="comment-{{ $comment->getKey() }}" class="media">
    @if ($comment->guest_email != null)
        <img class="mr-3" src="{{ Storage::url($client->photo) }}"
            alt="{{ $comment->commenter->name ?? $comment->guest_name }} Avatar"
            style="border-radius:50%; max-height:40px; max-width:40px;">
    @else
        <img class="mr-3" src="{{ Storage::url($user->photo) }}"
            alt="{{ $comment->commenter->name ?? $comment->guest_name }} Avatar"
            style="border-radius:50%; max-height:40px; max-width:40px; background-color:#ffffff;">
    @endif

    <div class="media-body">
        <h5 class="mt-0 mb-1">{{ $comment->commenter->name ?? $comment->guest_name }}
            <small class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small>
        </h5>
        <div style="white-space: pre-wrap; margin-bottom:32px;">{!! $markdown->line($comment->comment) !!}</div>

        <div class="button-row">
            @can('edit-comment', $comment)
                <button data-toggle="modal" data-target="#comment-modal-{{ $comment->getKey() }}"
                    class="btn btn-edit ">@lang('comments::comments.edit')</button>
            @endcan

            @can('delete-comment', $comment)
                <a href="{{ route('comments.destroy', $comment->getKey()) }}"
                    onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();"
                    class="btn btn-delete ">@lang('comments::comments.delete')</a>
                <form id="comment-delete-form-{{ $comment->getKey() }}"
                    action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
            @endcan
        </div>
    </div>

    @can('edit-comment', $comment)
        <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document" style="border:none;">
                <div class="modal-content">
                    <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                        @method('PUT')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('comments::comments.edit_comment')</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="message">@lang('comments::comments.update_your_message_here')</label>
                                <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                                {{-- <small class="form-text text-muted">@lang('comments::comments.markdown_cheatsheet', ['url' => 'https://help.github.com/articles/basic-writing-and-formatting-syntax'])</small> --}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-edit "
                                data-dismiss="modal">@lang('comments::comments.cancel')</button>
                            <button type="submit"
                                class="btn btn-delete">@lang('comments::comments.update')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('reply-to-comment', $comment)
        <div class="modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('comments::comments.reply_to_comment')</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="message">@lang('comments::comments.enter_your_message_here')</label>
                                <textarea required class="form-control" name="message" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase"
                                data-dismiss="modal" >@lang('comments::comments.cancel')</button>
                            <button type="submit"
                                class="btn btn-sm btn-outline-success text-uppercase">@lang('comments::comments.reply')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    <br />{{-- Margin bottom --}}

    <?php
    if (!isset($indentationLevel)) {
        $indentationLevel = 1;
    } else {
        $indentationLevel++;
    }
    ?>

    {{-- Recursion for children --}}
    @if ($grouped_comments->has($comment->getKey()) && $indentationLevel <= $maxIndentationLevel)
        @foreach ($grouped_comments[$comment->getKey()] as $child)
            @include('comments::_comment', [
                'comment' => $child,
                'grouped_comments' => $grouped_comments,
            ])
        @endforeach
    @endif
</div>

{{-- Recursion for children --}}
@if ($grouped_comments->has($comment->getKey()) && $indentationLevel > $maxIndentationLevel)
    @foreach ($grouped_comments[$comment->getKey()] as $child)
        @include('comments::_comment', [
            'comment' => $child,
            'grouped_comments' => $grouped_comments,
        ])
    @endforeach
@endif

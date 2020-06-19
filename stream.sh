VIDSOURCE="/dev/video0"
AUDIO_OPTS=""
VIDEO_OPTS="-s 640x480 -c:v libx264 -b:v 800000"
OUTPUT_HLS="-hls_time 10 -hls_list_size 10 -start_number 1"
ffmpeg -i "$VIDSOURCE" - y $AUDIO_OPTS $VIDEO_OPTS $OUTPUT_HLS mystream.m3u8
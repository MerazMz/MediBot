from flask import Flask, request, jsonify
from flask_socketio import SocketIO, emit, join_room, leave_room
import os

app = Flask(__name__)
socketio = SocketIO(app, cors_allowed_origins="*")

# Store active rooms
active_rooms = {}

@socketio.on('join')
def on_join(data):
    room = data['room']
    join_room(room)
    active_rooms[room] = active_rooms.get(room, 0) + 1
    emit('user_joined', {'count': active_rooms[room]}, room=room)

@socketio.on('leave')
def on_leave(data):
    room = data['room']
    leave_room(room)
    active_rooms[room] = max(0, active_rooms.get(room, 1) - 1)
    emit('user_left', {'count': active_rooms[room]}, room=room)

@socketio.on('offer')
def on_offer(data):
    emit('offer', data, room=data['room'], include_self=False)

@socketio.on('answer')
def on_answer(data):
    emit('answer', data, room=data['room'], include_self=False)

@socketio.on('ice_candidate')
def on_ice_candidate(data):
    emit('ice_candidate', data, room=data['room'], include_self=False)

if __name__ == '__main__':
    socketio.run(app, debug=True, port=5001) 
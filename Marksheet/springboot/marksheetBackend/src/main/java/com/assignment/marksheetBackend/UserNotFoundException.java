package com.assignment.marksheetBackend;

public class UserNotFoundException extends RuntimeException {

	public UserNotFoundException(Integer id) {
		super("Could Not Found the user with id " + id);
	}
}

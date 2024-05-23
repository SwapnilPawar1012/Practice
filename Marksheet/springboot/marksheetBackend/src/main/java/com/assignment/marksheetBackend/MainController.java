package com.assignment.marksheetBackend;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin("http://localhost:3000")
public class MainController {
	@Autowired
	private UserRepository userRepository;
	
	@PostMapping("/add")
	User newUser(@RequestBody User newUser) {
		return userRepository.save(newUser);
	}
	
	@GetMapping("/student/{id}")
	User getUsers(@PathVariable Integer id) {
		return userRepository.findById(id).orElseThrow(()->new UserNotFoundException(id));
	}
}

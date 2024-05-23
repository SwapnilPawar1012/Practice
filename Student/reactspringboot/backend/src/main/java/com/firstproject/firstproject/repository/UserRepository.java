package com.firstproject.firstproject.repository;

import com.firstproject.firstproject.model.User;
import org.springframework.data.jpa.repository.JpaRepository;

public interface UserRepository extends JpaRepository<User,Long> {
}

package com.assignment.marksheetBackend;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table
public class User {
	@Id
	@GeneratedValue(strategy = GenerationType.AUTO)
	private Integer id;
	
	@Column
	private String name;
	
	@Column
	private String email;
	
	@Column
	private Integer mse_cc;
	
	@Column
	private Integer mse_wt;
	
	@Column
	private Integer mse_daa;
	
	@Column
	private Integer mse_sdam;
	
	@Column
	private Integer ese_cc;

	@Column
	private Integer ese_wt;
	
	@Column
	private Integer ese_daa;
	
	@Column
	private Integer ese_sdam;

	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getEmail() {
		return email;
	}

	public void setEmail(String email) {
		this.email = email;
	}

	// MSE
	public Integer getMse_cc() {
		return mse_cc;
	}

	public void setMse_cc(Integer mse_cc) {
		this.mse_cc = mse_cc;
	}

	public Integer getMse_wt() {
		return mse_wt;
	}

	public void setMse_wt(Integer mse_wt) {
		this.mse_wt = mse_wt;
	}

	public Integer getMse_daa() {
		return mse_daa;
	}

	public void setMse_daa(Integer mse_daa) {
		this.mse_daa = mse_daa;
	}

	public Integer getMse_sdam() {
		return mse_sdam;
	}

	public void setMse_sdam(Integer mse_sdam) {
		this.mse_sdam = mse_sdam;
	}

	// ESE
	public Integer getEse_cc() {
		return ese_cc;
	}

	public void setEse_cc(Integer ese_cc) {
		this.ese_cc = ese_cc;
	}

	public Integer getEse_wt() {
		return ese_wt;
	}

	public void setEse_wt(Integer ese_wt) {
		this.ese_wt = ese_wt;
	}

	public Integer getEse_daa() {
		return ese_daa;
	}

	public void setEse_daa(Integer ese_daa) {
		this.ese_daa = ese_daa;
	}

	public Integer getEse_sdam() {
		return ese_sdam;
	}

	public void setEse_sdam(Integer ese_sdam) {
		this.ese_sdam = ese_sdam;
	}

	public User(Integer id, String name, String email, Integer mse_cc, Integer mse_wt, Integer mse_daa, Integer mse_sdam,
			Integer ese_cc, Integer ese_wt, Integer ese_daa, Integer ese_sdam) {
		super();
		this.id = id;
		this.name = name;
		this.email = email;
		this.mse_cc = mse_cc;
		this.mse_wt = mse_wt;
		this.mse_daa = mse_daa;
		this.mse_sdam = mse_sdam;
		this.ese_cc = ese_cc;
		this.ese_wt = ese_wt;
		this.ese_daa = ese_daa;
		this.ese_sdam = ese_sdam;
	}

	public User() {
		super();
		// TODO Auto-generated constructor stub
	}
}

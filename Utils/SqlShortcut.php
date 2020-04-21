<?php
namespace Utils;

abstract class SqlTrainingShortcut {
	const MAKE_TRAINING = "SELECT t_id, t_date, t_shape, exo_c_name, exo_p_work_load, exo_p_rest, exo_p_nb_sets, exo_p_nb_reps, m_name
				FROM `user`
				LEFT JOIN training ON t_fk_user_id = u_id
				LEFT JOIN exercise_practice ON t_id = exo_p_fk_training_id
				LEFT JOIN exercise_catalog ON exo_p_fk_exercise_catalog_id = exo_c_id
				LEFT JOIN method ON exo_p_fk_method_id = m_id
				WHERE t_id=?";
	const INSERT_TRAINING = "INSERT INTO training (t_fk_user_id, t_date, t_shape) VALUES (?, ?, ?)";
	const INSERT_EXERCISE = "INSERT INTO exercise_practice (exo_p_fk_training_id, exo_p_fk_exercise_catalog_id, exo_p_work_load, exo_p_rest, exo_p_nb_sets, exo_p_nb_reps, exo_p_fk_method_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
	const SELECT_TRAININGS_IDS = "SELECT DISTINCT(t_id), t_date FROM `user` LEFT JOIN training ON t_fk_user_id = u_id WHERE t_fk_user_id =? ORDER BY t_date DESC";
	const UPDATE_TRAINING = "UPDATE training SET t_date = ?, t_shape = ? WHERE t_id=?";
}

abstract class SqlUserShortcut {
	const GET_USER_BY_ID = "SELECT * FROM user LEFT JOIN activity ON u_fk_activity_id = a_id LEFT JOIN goal ON u_fk_goal_id = g_id WHERE u_id=?";
	const CREATE_USER = "INSERT INTO user (u_height, u_weight, u_fk_activity_id, u_fk_goal_id, u_age) VALUES (?, ?, ?, ?, ?)";
	const SAVE_DATA = "UPDATE user SET u_age=?, u_height=?, u_weight=?, u_fk_activity_id=?, u_fk_goal_id=? WHERE u_id=?";
	const ADD_WEIGHT = "INSERT INTO weight_tracking (wt_fk_user_id, wt_date, wt_weight) VALUES (?, ?, ?)";
	const GET_WEIGHT_TRACKING_BY_ID = "SELECT * FROM weight_tracking WHERE wt_fk_user_id = ?
		ORDER BY wt_date DESC";
}
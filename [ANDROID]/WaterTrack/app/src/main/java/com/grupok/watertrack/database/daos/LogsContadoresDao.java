package com.grupok.watertrack.database.daos;

import androidx.room.Dao;
import androidx.room.Insert;
import androidx.room.Query;
import androidx.room.Update;

import com.grupok.watertrack.database.entities.LogsContadoresEntity;

import java.util.List;

@Dao
public interface LogsContadoresDao {
    @Insert
    void insert(LogsContadoresEntity logsContador);

    @Update
    void update(LogsContadoresEntity logsContador);
    @Insert
    void insertList(List<LogsContadoresEntity> logsContadores);

    @Query("SELECT * FROM LOGS_contadores")
    List<LogsContadoresEntity> getLogsContadores();

    @Query("DELETE FROM LOGS_contadores")
    void clearAllEntries();
}


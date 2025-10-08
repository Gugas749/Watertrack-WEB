package com.grupok.watertrack.database.daos;

import androidx.room.Dao;
import androidx.room.Insert;
import androidx.room.Query;
import androidx.room.Update;

import com.grupok.watertrack.database.entities.ContadorEntity;
import com.grupok.watertrack.database.entities.UserInfosEntity;

import java.util.List;

@Dao
public interface ContadoresDao {
    @Insert
    void insert(ContadorEntity contador);

    @Update
    void update(ContadorEntity contador);
    @Insert
    void insertList(List<ContadorEntity> contadores);

    @Query("SELECT * FROM Contadores")
    List<ContadorEntity> getContadores();

    @Query("DELETE FROM Contadores")
    void clearAllEntries();
}


package com.grupok.watertrack.activitys;

import android.content.res.Configuration;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.KeyEvent;
import android.view.MenuItem;
import android.view.View;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.room.Room;

import com.google.android.material.navigation.NavigationView;
import com.grupok.watertrack.R;
import com.grupok.watertrack.database.LocalDataBase;
import com.grupok.watertrack.database.daos.AvariasContadoresDao;
import com.grupok.watertrack.database.daos.ContadoresDao;
import com.grupok.watertrack.database.daos.EmpresasDao;
import com.grupok.watertrack.database.daos.LogsContadoresDao;
import com.grupok.watertrack.database.daos.TecnicoInfoDao;
import com.grupok.watertrack.database.daos.TiposContadoresDao;
import com.grupok.watertrack.database.daos.UserInfosDao;
import com.grupok.watertrack.database.entities.AvariasContadoresEntity;
import com.grupok.watertrack.database.entities.ContadorEntity;
import com.grupok.watertrack.database.entities.EmpresasEntity;
import com.grupok.watertrack.database.entities.LogsContadoresEntity;
import com.grupok.watertrack.database.entities.TecnicoInfoEntity;
import com.grupok.watertrack.database.entities.TiposContadoresEntity;
import com.grupok.watertrack.database.entities.UserInfosEntity;
import com.grupok.watertrack.databinding.ActivityMainBinding;
import com.grupok.watertrack.fragments.mainactivityfrags.MainACMainView;
import com.grupok.watertrack.scripts.localDBCRUD.LocalDBgetAll;

import java.util.ArrayList;
import java.util.List;

public class MainActivity extends AppCompatActivity {

    private ActivityMainBinding binding;
    private MainActivity THIS;
    public UserInfosEntity currentUserInfo;
    private Boolean allDisable;
    private ActionBarDrawerToggle drawerToggleSideMenu;
    //-------------------LISTS---------------
    private List<LogsContadoresEntity> logsContEntitiesList;
    private List<ContadorEntity> contadoresEntityList;
    //-------------------LOCAL DATABASE---------------
    private LocalDataBase localDataBase;
    private LogsContadoresDao logsContadoresDao;
    private ContadoresDao contadoresDao;
    private AvariasContadoresDao avariasContadoresDao;
    private EmpresasDao empresasDao;
    private TecnicoInfoDao tecnicoInfoDao;
    private TiposContadoresDao tiposContadoresDao;
    private UserInfosDao userInfosDao;

    public interface DatabaseCallback {
        void onTaskCompleted(LocalDBgetAll result);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityMainBinding.inflate(getLayoutInflater());
        //EdgeToEdge.enable(this);
        setContentView(binding.getRoot());

        init();
    }

    private void init(){
        THIS = this;
        allDisable = false;
        disableBackPressed();
        logsContEntitiesList = new ArrayList<>();
        contadoresEntityList = new ArrayList<>();

        DatabaseCallback callback = new DatabaseCallback() {
            @Override
            public void onTaskCompleted(LocalDBgetAll result) {
                //carregou info da DB LOCAL
                logsContEntitiesList = result.logsContEntityList;
                contadoresEntityList = result.contadoresEntityList;
                currentUserInfo = result.userInfo;

                setupSideMenu();

                cycleFragments("MainViewFrag");
            }
        };

        setupLocalDataBase();
        new LocalDatabaseGetAllDataTask(callback).execute();
    }
    //----------------------SETUPS---------------------------
    private void setupLocalDataBase(){
        localDataBase = Room.databaseBuilder(getApplicationContext(), LocalDataBase.class, "WaterTrackLocalDB").build();
        logsContadoresDao = localDataBase.logsContadoresDao();
        contadoresDao = localDataBase.contadoresDao();
        avariasContadoresDao = localDataBase.avariasContadoresDao();
        empresasDao = localDataBase.empresasDao();
        tecnicoInfoDao = localDataBase.tecnicoInfoDao();
        tiposContadoresDao = localDataBase.tiposContadoresDao();
        userInfosDao = localDataBase.userInfosDao();
    }
    //----------------------SIDE MENU---------------------------
    private void setupSideMenu(){
        //-------------menu---------------------
        drawerToggleSideMenu = new ActionBarDrawerToggle(this,binding.drawerLayoutMainAcSideMenu,R.string.general_continue,R.string.general_cancel);
        binding.drawerLayoutMainAcSideMenu.addDrawerListener(drawerToggleSideMenu);
        drawerToggleSideMenu.syncState();
        //-----------------------------------------

        binding.imageViewButtonSideMenuMainAC.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(! binding.drawerLayoutMainAcSideMenu.isDrawerOpen(GravityCompat.END)){
                    binding.drawerLayoutMainAcSideMenu.openDrawer(GravityCompat.END);
                }
            }
        });

        binding.navigationViewMainAcSideMenu.setNavigationItemSelectedListener(new NavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                if(!allDisable){
                    item.setEnabled(false);
                    if (item.getItemId() == R.id.mainAc_SideBar_Share) {
                        //showShareBottomSheet();
                    }else if(item.getItemId() == R.id.mainAc_SideBar_RateUs){

                    }else if(item.getItemId() == R.id.mainAc_SideBar_Backups){
                        //runSwipeRightAnimation("Backups");
                    }else if(item.getItemId() == R.id.mainAc_SideBar_Configs){
                        //runSwipeRightAnimation("Settings");
                    }else if(item.getItemId() == R.id.mainAc_SideBar_Credits){
                        //runSwipeRightAnimation("Credits");
                    }
                    item.setEnabled(true);
                }
                return true;
            }
        });
        binding.navigationViewMainAcSideMenu.bringToFront();
    }
    private void enableSwipeToOpenSideMenu() {
        if (binding.drawerLayoutMainAcSideMenu != null) {
            binding.drawerLayoutMainAcSideMenu.setDrawerLockMode(DrawerLayout.LOCK_MODE_UNLOCKED);
        }
    }
    private void disableSwipeToOpenSideMenu() {
        if (binding.drawerLayoutMainAcSideMenu != null) {
            binding.drawerLayoutMainAcSideMenu.setDrawerLockMode(DrawerLayout.LOCK_MODE_LOCKED_CLOSED);
        }
    }
    //----------------------FUNCTIONS---------------------------
    private void disableBackPressed(){
        binding.getRoot().setFocusableInTouchMode(true);
        binding.getRoot().requestFocus();
        binding.getRoot().setOnKeyListener(new View.OnKeyListener() {
            @Override
            public boolean onKey(View v, int keyCode, KeyEvent event) {
                if (keyCode == KeyEvent.KEYCODE_BACK && event.getAction() == KeyEvent.ACTION_UP) {
                    return true;
                }
                return false;
            }
        });
    }
    public void cycleFragments(String goTo){
        switch (goTo){
            case "MainViewFrag":
                getSupportFragmentManager().beginTransaction().replace(R.id.frameLayout_fragmentContainer_MainAC, new MainACMainView(this, contadoresEntityList)).commitAllowingStateLoss();
                break;
        }
    }
    //----------------------THEME DEBUGGER---------------------------
    @Override
    public void onConfigurationChanged(@NonNull Configuration newConfig) {
        super.onConfigurationChanged(newConfig);
        if (newConfig.uiMode != getApplicationContext().getResources().getConfiguration().uiMode) {
            recreate();
        }
    }
    //----------------------DATABASE OPERATIONS---------------------------
    private class LocalDatabaseGetAllDataTask extends AsyncTask<Void, Void, LocalDBgetAll> {
        private DatabaseCallback callback;

        public LocalDatabaseGetAllDataTask(DatabaseCallback callback) {
            this.callback = callback;
        }

        @Override
        protected LocalDBgetAll doInBackground(Void... voids) {
            Log.i("WATERTRACKINFO", "Fetching data from local DB...");
            List<LogsContadoresEntity> list1 = logsContadoresDao.getLogsContadores();
            List<ContadorEntity> list2 = contadoresDao.getContadores();
            List<AvariasContadoresEntity> list3 = avariasContadoresDao.getAvariasContadores();
            List<EmpresasEntity> list4 = empresasDao.getEmpresas();
            List<TecnicoInfoEntity> list5 = tecnicoInfoDao.getTecnicosInfo();
            List<TiposContadoresEntity> list6 = tiposContadoresDao.getTiposContadores();
            UserInfosEntity userInfos = userInfosDao.getUserInfos().get(0);//TODO: id

            return new LocalDBgetAll(list1, list2, list3, list4, list5, list6, userInfos);
        }

        @Override
        protected void onPostExecute(LocalDBgetAll result) {
            if (callback != null) {
                callback.onTaskCompleted(result);
            }
        }
    }

}
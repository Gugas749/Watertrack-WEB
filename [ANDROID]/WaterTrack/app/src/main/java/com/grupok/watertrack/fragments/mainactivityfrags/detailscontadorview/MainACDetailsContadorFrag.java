package com.grupok.watertrack.fragments.mainactivityfrags.detailscontadorview;

import android.content.Context;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;

import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.grupok.watertrack.R;
import com.grupok.watertrack.activitys.MainActivity;
import com.grupok.watertrack.database.entities.ContadorEntity;
import com.grupok.watertrack.database.entities.LogsContadoresEntity;
import com.grupok.watertrack.databinding.FragmentMainACDetailsContadorBinding;
import com.grupok.watertrack.databinding.FragmentMainACReadingsContadorBinding;
import com.grupok.watertrack.databinding.FragmentMainAcAddContadorBinding;
import com.grupok.watertrack.fragments.mainactivityfrags.readingscontadorview.MainACReadingsContadorFrag;
import com.grupok.watertrack.fragments.mainactivityfrags.readingscontadorview.RVAdapterFieldsReadingsContadores;
import com.grupok.watertrack.fragments.mainactivityfrags.readingscontadorview.RVAdapterReadingsACReadingsContadores;

import java.util.ArrayList;
import java.util.List;


public class MainACDetailsContadorFrag extends Fragment {

    private MainActivity parent;
    private Context context;
    private MainACDetailsContadorFrag THIS;
    private FragmentMainACDetailsContadorBinding binding;
    private List<ContadorEntity> contadoresEntityList;
    private RVAdapterFieldsDetailsContadores fieldsAdapter;
    private int contadorId;

    public MainACDetailsContadorFrag() {
        // Required empty public constructor
    }


    public MainACDetailsContadorFrag(MainActivity parent, List<ContadorEntity> contadoresEntityList) {
        this.parent = parent;
        this.contadoresEntityList = contadoresEntityList;
    }
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        binding = FragmentMainACDetailsContadorBinding.inflate(inflater);

        if(parent.currentUserInfo != null){
            init();
        }

        if (getArguments() != null) {
            contadorId = getArguments().getInt("contadorId", -1);
            Log.d("LOGTESTE", "Received contadorId: " + contadorId);
        }

        return binding.getRoot();
    }

    private void init(){
        THIS = this;
        context = getContext();

        fieldsAdapter = new RVAdapterFieldsDetailsContadores(context, contadoresEntityList.get(0));

        binding.rvFieldsInfoContadorMainAc.setLayoutManager(new LinearLayoutManager(context));
        binding.rvFieldsInfoContadorMainAc.setAdapter(fieldsAdapter);


        binding.buttonDetailsContador.setOnClickListener(v -> {
            Bundle data = new Bundle();
            data.putInt("contadorId", contadorId);
            parent.cycleFragments("ReadingsContadorFrag", data);
        });
    }

}